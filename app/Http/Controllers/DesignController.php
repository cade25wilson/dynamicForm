<?php

namespace App\Http\Controllers;

use App\Models\FormDesign;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DesignController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $validatedData = $request->validate([
                'background' => 'required|hex_color',
                'questions' => 'required|hex_color',
                'answers' => 'required|hex_color',
                'buttons' => 'required|hex_color',
                'button_text' => 'required|hex_color',
                'star_rating' => 'required|hex_color',
                'font' => 'required|string|max:255',
                'logo' => 'nullable|string',
                'form_id' => 'required|string'
            ]);
        
            $design = FormDesign::findOrFail($id);
            $design->update($validatedData);
            return;
        } catch(Exception $e){
            Log::error($e);;
        }
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
            Log::error($e);;
        }
    }
}
