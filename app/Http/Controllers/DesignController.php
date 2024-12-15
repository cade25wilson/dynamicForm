<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteBackgroundImage;
use App\Models\FormDesign;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DesignController extends Controller
{
    /**
     * Update the specified resource in storage.
     */

    public function updateSettings(Request $request, string $id)
    {
        Log::info($request);
        try {
            $fillableColumns = (new FormDesign)->getFillable();
            $data = $request->validate([
                'input' => 'required|in:' . implode(',', $fillableColumns),
                'value' => 'boolean'
            ]);

            FormDesign::where('id', $id)->firstOrFail()->update([
                $data['input'] => $data['value']
            ]);

            return response(null, 204);
        } catch(Exception $e){
            Log::error($e);
            return response(null, 500);
        }
    }
    
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

            return response(json_encode(['background_image' => $background_image]), 200);
        } catch(Exception $e){
            Log::error($e);
            return response(null, 500);
        }
    }

    public function removeBackground(Request $request, string $id)
    {
        try {
            // Retrieve the current background image path
            $formDesign = FormDesign::where('form_id', $id)->firstOrFail();

            DeleteBackgroundImage::dispatch($formDesign->background_image);

            $formDesign->update(['background_image' => null]);

            return response()->json(['message' => 'Background image removed successfully'], 200);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'Failed to remove background image'], 500);
        }
    }

}
