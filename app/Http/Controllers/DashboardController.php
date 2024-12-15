<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();
        $forms = Form::where('user_id', Auth::id())
        ->withCount('responses')
        ->get();
    
        return Inertia::render('Dashboard', [
            'forms' => $forms,
            'isPro' => $isPro
        ]);
    }
}
