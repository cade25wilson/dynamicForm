<?php

namespace App\Http\Controllers;

use App\Exports\FormResponsesExport;
use App\Jobs\FormCompletion;
use App\Models\Form;
use App\Models\FormFieldResponses;
use App\Models\FormResponses;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FormResponseController extends Controller
{

    public function complete(Request $request)
    {
        try {
            $data = $request->validate([
                'responseId' => 'required|exists:form_responses,id',
                'formid' => 'required|exists:published_forms,id'
            ]);
            $formResponse = FormResponses::where('id', $data['responseId'])->firstOrFail();
            if(!$formResponse->is_complete){
                $formResponse->update(['is_complete' => true]);
                FormCompletion::dispatch($data['formid'], $data['responseId']);
            }
            return response(null, 204);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $form = Form::with([
            'publishedForm.sections.publishedFormFields',
            'responses.fieldResponses'
        ])->findOrFail($id);

        $formData = $form->only(['id', 'name']);
        $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();

        $publishedFormFields = $form->publishedForm->sections->flatMap(function ($section) {
            return $section->publishedFormFields;
        })->pluck('label', 'id');
    
        $tableData = [
            'headers' => $publishedFormFields->values()->all(),
        ];
    
        $mapResponseToRow = function ($response) use ($publishedFormFields) {
            $row = ['response_id' => $response->id];
            $fieldResponses = $response->fieldResponses->pluck('value', 'form_field_id');
    
            foreach ($publishedFormFields as $fieldId => $label) {
                $row[] = $fieldResponses[$fieldId] ?? null;
            }
    
            return $row;
        };
    
        // Filter completed and partial responses and map them to rows
        $completedResponses = $form->responses->filter(function ($response) {
            return $response->is_complete;
        })->map($mapResponseToRow);
    
        $partialResponses = $form->responses->filter(function ($response) {
            return !$response->is_complete;
        })->map($mapResponseToRow);
    
        // Return the view with completed and partial responses as well
        return Inertia::render('Responses', [
            'tableData' => $tableData,
            'form' => $formData,
            'isPro' => $isPro,
            'completed' => $completedResponses->count(),
            'partial' => $partialResponses->count(),
            'completeResponses' => $completedResponses->toArray(),
            'partialResponses' => $partialResponses->toArray()    ,
            'has_published_form' => 'true'
        ]);
    }

    public function getResponses(string $id)
    {
        $form = Form::with([
            'responses.fieldResponses',
            'publishedForm.sections.publishedFormFields',
        ])->findOrFail($id);

        $publishedFormFields = $form->publishedForm->sections->flatMap(function ($section) {
            return $section->publishedFormFields;
        })->pluck('label', 'id');

        $mapResponseToRow = function ($response) use ($publishedFormFields) {
            $row = ['response_id' => $response->id];
            $fieldResponses = $response->fieldResponses->pluck('value', 'form_field_id');

            foreach ($publishedFormFields as $fieldId => $label) {
                $row[] = $fieldResponses[$fieldId] ?? null;
            }

            return $row;
        };

        // Filter completed and partial responses and map them to rows
        $completedResponses = $form->responses->filter(function ($response) {
            return $response->is_complete;
        })->map($mapResponseToRow);

        $partialResponses = $form->responses->filter(function ($response) {
            return !$response->is_complete;
        })->map($mapResponseToRow);

        return response()->json([
            'completed' => $completedResponses->count(),
            'partial' => $partialResponses->count(),
            'completeResponses' => $completedResponses->toArray(),
            'partialResponses' => $partialResponses->toArray(),
        ]);
    }
    
    public function showResponse(string $id, string $responseId)
    {
        try{
            $form = Form::with(['publishedForm.sections.publishedFormFields'])->findOrFail($id);
            $publishedFormFields = $form->publishedForm->sections->flatMap(function ($section) {
                return $section->publishedFormFields;
            })->pluck('label', 'id');

            $response = FormResponses::where('form_id', $id)->findOrFail($responseId);
            $fieldResponses = FormFieldResponses::where('response_id', $response->id)
                ->pluck('value', 'form_field_id');
        
            $responseData = [];
            foreach ($publishedFormFields as $fieldId => $label) {
                $responseData['data'][$label] = $fieldResponses[$fieldId] ?? null;
            }

            $responseData['time'] = date('M j, Y g:i a', strtotime($response->updated_at));
            return response()->json($responseData);
        } catch(Exception $e){
            Log::error($e);
        }
    }

    public function download(string $id, Request $request)
    {
        try{
            $data = $request->validate([
                'responses' => 'array|nullable'
            ]);
            
            $form = Form::with(['publishedForm.sections.publishedFormFields'])->findOrFail($id);
            $publishedFormFields = $form->publishedForm->sections->flatMap(function ($section) {
                return $section->publishedFormFields;
            })->pluck('label', 'id');
        
            $formResponses = $this->getData($data['responses'], $id);
        
            $export = new FormResponsesExport($formResponses, $publishedFormFields);
            $spreadsheet = $export->generate();
        
            $fileName = 'form_responses_' . $form->name . '.xlsx';
            $writer = new Xlsx($spreadsheet);
            $filePath = storage_path("app/{$fileName}");
            $writer->save($filePath);
        
            return response()->download($filePath)->deleteFileAfterSend(true);
        } catch(Exception $e){
            Log::error($e);
        }
    }

    private function getData(?array $response, string $id): Collection
    {
        if (empty($response)) {
            $formResponses = FormResponses::where('form_id', $id)->get();
        } else {
            $formResponses = FormResponses::where('form_id', $id)
                ->whereIn('id', $response)
                ->get();
        }
        return $formResponses;   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $data = $request->validate([
                'responses' => 'array|required'
            ]);        
            FormResponses::destroy($data['responses']);
        } catch(Exception $e){
            Log::error($e);;
        }
    }
}
