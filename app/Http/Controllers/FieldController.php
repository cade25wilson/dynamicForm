<?php

namespace App\Http\Controllers;

use App\Models\FormFields;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FieldController extends Controller
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
    public function store(Request $request)
    {
        //
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
        Log::info($request);
        $data = $request->validate([
            'label' => 'nullable|string',
            'placeholder' => 'nullable|string',
            'show' => 'required|boolean',
            'required' => 'required|boolean',
        ]);

        FormFields::where('id', $id)->firstOrFail()->update($data);
        return;
    }

    public function maxlength(Request $request, string $id)
    {
        Log::info($request);
        try {
            $data = $request->validate([
                'length' => 'numeric|nullable'
            ]);
            if($data['length'] === NULL){
                $data['length'] = "";
            }
            // Find the form field by ID
            $formField = FormFields::where('id', $id)->firstOrFail();
            $options = json_decode($formField->options, true);
            $options['length'] = $data['length']; // Replace $newLength with your desired value
            $formField->options = json_encode($options);
            $formField->save();
            return;
        } catch(Exception $e){
            Log::info($e);
            return;
        }
    }

    public function option(Request $request, string $id)
    {
        Log::info('here');
        Log::info($request);
        // Validate incoming request data
        $data = $request->validate([
            'name' => 'string|required'
        ]);
        Log::info('data ' . $data['name']);

        // Find the FormFields record by id
        $formField = FormFields::where('id', $id)->firstOrFail();
    
        // Decode the existing options JSON
        $options = json_decode($formField->options, true);
    
        // Add the new choice to the choices array
        if (isset($options['choices']) && is_array($options['choices'])) {
            $options['choices'][] = $data['name']; // Add the new choice
        } else {
            $options['choices'] = [$data['name']]; // Initialize choices array if not set
        }
    
        // Encode the updated options array back to JSON
        $formField->options = json_encode($options);
    
        // Save the updated record
        $formField->save();
    
        // Optionally return a response
        // return response()->json(['message' => 'Option added successfully'], 200);
        return;
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
