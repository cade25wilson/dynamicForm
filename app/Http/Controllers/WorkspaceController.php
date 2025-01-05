<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WorkspaceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'workspaceName' => 'required|string',
            ]);

            $workspace = Workspace::create([
                'name' => $data['workspaceName'],
                'user_id' => Auth::id()
            ]);
            
            return redirect('/dashboard?workspace=' . $workspace->id);
        } catch(Exception $e){
            Log::error($e);
            return response("error creating workspace", 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'name' => 'required|string',
            ]);

            Workspace::where('id', $id)->update(['name' => $data['name']]);
            return response()->noContent();
        } catch(Exception $e){
            Log::error($e);
            return response('error updating workspace name', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Workspace::where('id', $id)->delete();
            return response()->noContent();
        } catch(Exception $e){
            Log::error($e);
            return response('error deleting workspace', 500);
        }
    }
}
