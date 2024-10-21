<?php

namespace App\Http\Controllers;

use App\Models\FormUtmParameter;
use App\Models\FormUtmResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UtmController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'field' => 'string|required'
            ]);
    
            // Check if the utm_key already exists for the given form_id
            $existingParam = FormUtmParameter::where('form_id', $id)
                ->where('utm_key', $data['field'])
                ->first();
    
            if ($existingParam) {
                return response()->json(['error' => 'UTM key already exists for this form.'], 409);
            }
    
            FormUtmParameter::create([
                'form_id' => $id,
                'utm_key' => $data['field']
            ]);
    
            return response()->noContent();
        } catch (Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'field' => 'string|required'
            ]);

            FormUtmParameter::where('form_id', $id)->where('utm_key', $data['field'])->delete();
            return response()->noContent();
        }catch(Exception $e){
            Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }        
    }

    public function response(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'utmValues' => 'array|nullable',
                'formId' => 'required|exists:forms,id'
            ]);

            if(empty($data['utmValues'])){
                return response()->noContent();
            }

            $paramData = [];
            foreach($data['utmValues'] as $key => $value) {
                $paramId = FormUtmParameter::where('form_id', $data['formId'])
                        ->where('utm_key', $key)
                        ->pluck('id')
                        ->first();                
                $paramData[] = [
                    'form_utm_parameters' => $paramId,
                    'utm_value' => $value,
                    'form_responses_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            FormUtmResponse::insert($paramData);
        }catch(Exception $e){
            Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
