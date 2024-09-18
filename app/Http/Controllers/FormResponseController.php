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
        // Retrieve the form along with related published form, sections, and fields in one query
        $form = Form::with(['publishedForm.sections.publishedFormFields'])->findOrFail($id);
    
        // Flatten fields across all sections into a collection and pluck 'label' and 'id'
        $publishedFormFields = $form->publishedForm->sections->flatMap(function ($section) {
            return $section->publishedFormFields;
        })->pluck('label', 'id');
    
        // Retrieve the individual form response by ID
        $response = FormResponses::where('form_id', $id)->findOrFail($responseId);
    
        // Retrieve the field responses for the specific form response
        $fieldResponses = FormFieldResponses::where('response_id', $response->id)
            ->pluck('value', 'form_field_id');
    
        // Prepare associative array where headers are keys and row values are values
        $responseData = [];
        foreach ($publishedFormFields as $fieldId => $label) {
            $responseData[$label] = $fieldResponses[$fieldId] ?? null;
        }
    
        // Return the response data as JSON
        return response()->json($responseData);
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
