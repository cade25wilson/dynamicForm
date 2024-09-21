<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormFieldResponses;
use App\Models\FormFields;
use App\Models\FormResponses;
use App\Models\PublishedForm;
use App\Models\PublishedFormField;
use App\Models\PublishedFormSection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FormResponseController extends Controller
{

    public function complete(Request $request)
    {
        try {
            // Validate the request
            $data = $request->validate([
                'responseId' => 'required|exists:form_responses,id',
            ]);

            // Update the 'is_complete' field in the 'form_responses' table
            FormResponses::where('id', $data['responseId'])->update(['is_complete' => true]);
            
        } catch (Exception $e) {
            // Log the error
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
        // Retrieve the form along with related published form, sections, and fields in one query
        $form = Form::with(['publishedForm.sections.publishedFormFields'])->findOrFail($id);

        // Flatten fields across all sections into a collection and pluck 'label' and 'id'
        $publishedFormFields = $form->publishedForm->sections->flatMap(function ($section) {
            return $section->publishedFormFields;
        })->pluck('label', 'id');

        // Retrieve all form responses
        $formResponses = FormResponses::where('form_id', $id)->get();

        // Prepare table headers and rows
        $tableData = [
            'headers' => $publishedFormFields->values()->all(),
            'rows' => []
        ];

        // Loop through each form response
        foreach ($formResponses as $response) {
            $row = ['response_id' => $response->id];
            $fieldResponses = FormFieldResponses::where('response_id', $response->id)
                ->pluck('value', 'form_field_id');

            foreach ($publishedFormFields as $fieldId => $label) {
                $row[] = $fieldResponses[$fieldId] ?? null;
            }
            $tableData['rows'][] = $row;
        }
        $formData = $form->only(['id', 'name']);

        // Pass the data to the view
        return Inertia::render('Responses', [
            'tableData' => $tableData,
            'form' => $formData
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
            'responses' => 'array|nullable' // Array of response IDs or null
        ]);

        $form = Form::with(['publishedForm.sections.publishedFormFields'])->findOrFail($id);

        $publishedFormFields = $form->publishedForm->sections->flatMap(function ($section) {
            return $section->publishedFormFields;
        })->pluck('label', 'id');

        if (empty($data['responses'])) {
            $formResponses = FormResponses::where('form_id', $id)->get();
        } else {
            $formResponses = FormResponses::where('form_id', $id)
                ->whereIn('id', $data['responses'])
                ->get();
        }

        $csvData = [];
        $csvData[] = array_merge(['Response ID'], $publishedFormFields->values()->all()); // Headers

        foreach ($formResponses as $response) {
            $row = [$response->id];
            $fieldResponses = FormFieldResponses::where('response_id', $response->id)
                ->pluck('value', 'form_field_id');

            foreach ($publishedFormFields as $fieldId => $label) {
                $row[] = $fieldResponses[$fieldId] ?? null;
            }

            $csvData[] = $row;
        }

        $fileName = 'form_responses_' . $form->id . '.csv';
        $handle = fopen(storage_path("app/{$fileName}"), 'w');

        foreach ($csvData as $line) {
            fputcsv($handle, $line);
        }
        fclose($handle);

        return Response::download(storage_path("app/{$fileName}"), $fileName)->deleteFileAfterSend(true);
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
    public function destroy(string $id)
    {
        //
    }
}
