<?php

namespace App\Http\Controllers;

use App\Models\Logic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogicController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'form_section_id' => 'required|exists:form_sections,id',
                'is_always' => 'required|boolean',
                'condition' => 'required|array',
                'condition.*.section_id' => 'required|exists:form_sections,id', // Section being evaluated
                'condition.*.operator' => 'required|string', // E.g., "is", "is not"
                'condition.*.value' => 'required|string', // Value to compare
                'condition.*.logical_operator' => 'nullable|string|in:AND,OR', // Logical operator
                'action' => 'required|array',
                'action.type' => 'required|string|in:goto',
                'action.target' => 'required|exists:form_sections,id', // Target section
            ]);
        
            $logic = Logic::create($data);
        
            return response()->json(['message' => 'Logic rule created successfully', 'logic' => $logic], 201);
        } catch(Exception $e){
            Log::error($e);
            return response($e, 500);
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'form_section_id' => 'required|exists:form_sections,id',
                'is_always' => 'required|boolean',
                'condition' => 'required|array',
                'condition.*.section_id' => 'required|exists:form_sections,id', // Section being evaluated
                'condition.*.operator' => 'required|string', // E.g., "is", "is not"
                'condition.*.value' => 'required|string', // Value to compare
                'condition.*.logical_operator' => 'nullable|string|in:AND,OR', // Logical operator
                'action' => 'required|array',
                'action.type' => 'required|string|in:goto',
                'action.target' => 'required|exists:form_sections,id', // Target section
            ]);
            $logic = Logic::findOrFail($id);
            $logic->update($data);
        
            return response()->noContent();
        } catch(Exception $e){
            Log::error($e);
            return response($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $logic = Logic::findOrFail($id);
            $logic->delete($id);
            return response()->noContent();
        } catch(Exception $e){
            Log::error($e);
            return response("there was an error deleting the logic", 500);
        }
    }
}
