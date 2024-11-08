<?php

namespace App\Http\Controllers;

use App\Models\FormIntegrations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IntegrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function webhook(string $id, Request $request)
    {
        Log::info($request);
        try{
            $data = $request->validate([
                'webhook' => 'required|url:https'
            ]);

            FormIntegrations::findOrFail($id)->update(['webhook' => $data['webhook']]);
        } catch(Exception $e){
            Log::error($e);
            return response(NULL, 500);
        }

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
