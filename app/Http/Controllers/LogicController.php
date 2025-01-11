<?php

namespace App\Http\Controllers;

use App\Models\Logic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogicController extends Controller
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
        try{
            $data = $request->validate([
                'form_section_id' => 'required|exists:form_sections,id',
                'condition' => 'required|array',
                'condition.*.section_id' => 'required|exists:form_sections,id', // Section being evaluated
                'condition.*.operator' => 'required|string', // E.g., "is", "is not"
                'condition.*.value' => 'required|string', // Value to compare
                'condition.*.logical_operator' => 'nullable|string|in:AND,OR', // Logical operator
                'action' => 'required|array',
                'action.type' => 'required|string|in:goto',
                'action.target' => 'required|exists:form_sections,id', // Target section
                'default_action' => 'nullable|array',
                'default_action.type' => 'nullable|string|in:goto',
                'default_action.target' => 'nullable|exists:form_sections,id', // Default target
            ]);
        
            $logic = Logic::create($data);
        
            return response()->json(['message' => 'Logic rule created successfully', 'logic' => $logic], 201);
        } catch(Exception $e){
            Log::error($e);
            return response($e, 500);
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
