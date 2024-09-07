<?php

namespace App\Http\Controllers;

use App\Models\FormDesign;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DesignController extends Controller
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
        $validatedData = $request->validate([
            'background' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'questions' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'answers' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'buttons' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'button_text' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'star_rating' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'font' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'form_id' => 'required|string'
        ]);
    
        // Proceed with updating the design
        $design = FormDesign::findOrFail($id);
        $design->update($validatedData);
        return;
    }

    public function setBackground(Request $request, string $id)
    {
        try{
            $request->validate([
                'background_image' => 'file|required'
            ]);

            $file = $request->file('background_image');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = "{$originalName}-{$id}.{$extension}";

            $file->move(public_path('background'), $filename);
            $background_image = "/background/{$filename}";

            FormDesign::where('form_id', $id)->update(['background_image' => $background_image]);
        } catch(Exception $e){
            Log::info($e);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
