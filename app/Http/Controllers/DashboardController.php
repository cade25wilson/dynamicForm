<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'workspace' => 'nullable|exists:workspaces,id'
        ]);
    
        $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();
    
        $workspaces = Workspace::where('user_id', Auth::id())
            ->withCount('forms')
            ->get();
    
        $workspaceId = $data['workspace'] ?? null;
        // Handle the current workspacea
        if(!$workspaceId){
            $currentWorkspace = Workspace::where('user_id', Auth::id())
                ->orderBy('name', 'asc')
                ->with(['forms' => function ($query) {
                    $query->withCount('responses');
                }])
                ->first();
        } else {
            $currentWorkspace = Workspace::where('id', $data['workspace'])
                ->where('user_id', Auth::id())
                ->with(['forms' => function ($query) {
                    $query->withCount('responses');
                }])
                ->first();
        }
        
        return Inertia::render('Dashboard', [
            // 'forms' => $forms,
            'workspaces' => $workspaces,
            'isPro' => $isPro,
            'currentWorkspace' => $currentWorkspace
        ]);
    }    
}
