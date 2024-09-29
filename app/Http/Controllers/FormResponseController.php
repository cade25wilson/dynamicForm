<?php

namespace App\Http\Controllers;

use App\Exports\FormResponsesExport;
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
            // Validate the request
            $data = $request->validate([
                'responseId' => 'required|exists:form_responses,id',
            ]);

            FormResponses::where('id', $data['responseId'])->update(['is_complete' => true]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Eager load all necessary relationships
        $form = Form::with([
            'publishedForm.sections.publishedFormFields',
            'responses.fieldResponses' // Eager load field responses
        ])->findOrFail($id);
    
        $publishedFormFields = $form->publishedForm->sections->flatMap(function ($section) {
            return $section->publishedFormFields;
        })->pluck('label', 'id');
    
        $tableData = [
            'headers' => $publishedFormFields->values()->all(),
            'rows' => []
        ];
    
        // Check if there are responses
        if ($form->responses) {
            // Transform responses and their field responses
            $tableData['rows'] = $form->responses->map(function ($response) use ($publishedFormFields) {
                $row = ['response_id' => $response->id];
                $fieldResponses = $response->fieldResponses->pluck('value', 'form_field_id');
    
                foreach ($publishedFormFields as $fieldId => $label) {
                    $row[] = $fieldResponses[$fieldId] ?? null;
                }
    
                return $row;
            })->toArray();
        }
    
        $formData = $form->only(['id', 'name']);
        $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();
        
        return Inertia::render('Responses', [
            'tableData' => $tableData,
            'form' => $formData,
            'isPro' => $isPro
        ]);
    }
    
    public function showResponse(string $id, string $responseId)
    {
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
    }

    public function download(string $id, Request $request)
    {
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->validate([
            'responses' => 'array|required'
        ]);
        try{
            FormResponses::destroy($data['responses']);
        } catch(Exception $e){
            Log::info($e);
        }
    }
}
