<?php

namespace App\Http\Controllers;

use App\Models\DefaultAction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DefaultActionController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'form_section_id' => 'required||exists:form_sections,id',
                'type' => 'required|string|in:goto',
                'target' => 'required||exists:form_sections,id'
            ]);

            $defaultAction = DefaultAction::findOrFail($id);
            $defaultAction->update($data);
            
            return response()->noContent();
        }catch(Exception $e){
            Log::error($e);
            return response(null, 500);
        }
    }
}
