<?php

namespace App\Http\Controllers;

use App\Models\FormFields;
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
