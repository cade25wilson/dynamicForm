<?php

namespace App\Http\Controllers;

use App\Models\FormFieldResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FormFieldResponseController extends Controller
{
    public function fileUpload(Request $request, string $id)
    {
        try {
            // Validate the request
            $data = $request->validate([
                'fieldId' => 'required|exists:form_fields,id',
                'files' => 'required|array',
                'files.*' => 'file|max:10240'
            ]);
            $uploadPath = public_path("file_uploads/{$id}");
    
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
    
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $filename = "{$originalName}.{$extension}";
    
                    $file->move($uploadPath, $filename);
                }
            }
    
            // Create a FormFieldResponse
            FormFieldResponses::create([
                'response_id' => $id,
                'form_field_id' => $data['fieldId'],
                'value' => "/file_uploads/{$id}"
            ]);
    
        } catch (Exception $e) {
            Log::error($e);;
        }
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

            if($request->file('value')){
                $file = $request->file('value');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = "{$originalName}-{$id}.{$extension}";
                $file->move(public_path('signature'), $filename);
                $data['value'] = "/signature/{$filename}";
            }

            $formFieldResponse = FormFieldResponses::where('form_field_id', $data['fieldId'])
            ->where('response_id', $id)
            ->first();
            
            if($formFieldResponse){
                $formFieldResponse->delete();
            }

            FormFieldResponses::create([
                'response_id' => $id,
                'form_field_id' => $data['fieldId'],
                'value' => $data['value']
            ]);
        }catch(Exception $e){
            Log::error($e);;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $fieldId)
    {
        try{
            if (file_exists(public_path("signature/signature-{$id}.svg"))) {
                Storage::disk('public')->delete("signature/signature-{$id}.svg");
            }
            FormFieldResponses::where('response_id', $id)->where('form_field_id', $fieldId)->delete();
        } catch(Exception $e){
            Log::error($e);
        }
    }
}
