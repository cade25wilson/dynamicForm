<?php

namespace App\Http\Controllers;

use App\Models\FormFieldResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormFieldResponseController extends Controller
{
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
    public function store(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'fieldId' => 'required|exists:form_fields,id',
                'value' => 'nullable'
            ]);
            $formFieldResponse = FormFieldResponses::where('form_field_id', $data['fieldId'])
            ->where('response_id', $id)
            ->first();
            
            if($formFieldResponse){
                Log::info($formFieldResponse);
                $formFieldResponse->delete();
            }

            FormFieldResponses::create([
                'response_id' => $id,
                'form_field_id' => $data['fieldId'],
                'value' => $data['value']
            ]);

        }catch(Exception $e){
            Log::info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
