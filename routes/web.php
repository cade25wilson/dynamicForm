<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SectionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('form', FormController::class);
    Route::delete('section/{id}', [SectionController::class, 'destroy'])->name('section.destroy');
    Route::post('section', [SectionController::class, 'store'])->name('section.store');
    Route::post('section/{id}', [SectionController::class, 'duplicate'])->name('section.duplicate');
    Route::put('background/{id}', [SectionController::class, 'backgroundImage']);
    Route::put('section/{id}', [SectionController::class, 'update']);
    Route::put('design/{id}', [DesignController::class, 'update']);
    Route::put('field/{id}', [FieldController::class, 'update']);
    Route::put('field/maxlength/{id}', [FieldController::class, 'maxlength']);
    Route::put('field/option/{id}', [FieldController::class, 'option']);
    Route::put('field/update/option/{id}', [FieldController::class, 'updateoption']);
    Route::put('field/align/{id}', [FieldController::class, 'align']);
    Route::put('field/randomize/{id}', [FieldController::class, 'randomize']);
    Route::put('field/hide-label/{id}', [FieldController::class, 'hidelabel']);
    Route::put('field/option/choice/{id}', [FieldController::class, 'deleteoption']);
    Route::put('field/option/bulk/{id}', [FieldController::class, 'bulkoption']);
    Route::put('field/update/image/{id}', [FieldController::class, 'addimage']);
    Route::put('field/update/imagelink/{id}', [FieldController::class, 'addimagelink']);
    Route::put('field/delete/image/{id}', [FieldController::class, 'removeimage']);
});