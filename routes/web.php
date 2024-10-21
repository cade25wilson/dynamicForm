<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldResponseController;
use App\Http\Controllers\FormResponseController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\PublishFormController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UtmController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Cashier\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Mail;

Route::get('/email', function () {
    $i=1;
    while ($i <= 10){
        Mail::raw('This is a test email.', function ($message) {
            $message->to('cade25wilson@gmail.com')
                    ->subject('Test Email');
        });
    }
    $i++;
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/responses/{id}', [FormResponseController::class, 'show']);
Route::get('forms/{id}', [PublishFormController::class, 'show']);
Route::get('responses/{id}/{responseId}', [FormResponseController::class, 'showResponse']);
Route::post('stripe/webhook', [WebhookController::class, 'handleWebhook']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/connect/{id}', [FormController::class, 'connect']);
    Route::get('/share/{id}', [FormController::class, 'share']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('form', FormController::class);
    Route::delete('section/{id}', [SectionController::class, 'destroy'])->name('section.destroy');
    Route::post('section', [SectionController::class, 'store'])->name('section.store');
    Route::post('section/{id}', [SectionController::class, 'duplicate'])->name('section.duplicate');
    Route::post('publish/{id}', [PublishFormController::class, 'store']);
    Route::put('section/background/{id}', [SectionController::class, 'backgroundImage']);
    Route::put('design/background/{id}', [DesignController::class, 'setBackground']);
    Route::put('section/{id}', [SectionController::class, 'update']);
    Route::put('section/single/{id}', [SectionController::class, 'singleField']);
    Route::put('section/ending/{id}', [SectionController::class, 'updateEnding']);
    Route::put('design/{id}', [DesignController::class, 'update']);
    Route::put('design/settings/{id}', [DesignController::class, 'updateSettings']);
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
    Route::put('field/schedule/platform/{id}', [FieldController::class, 'scheduleprovider']);
    Route::put('field/schedule/link/{id}', [FieldController::class, 'schedulelink']);
    Route::put('field/label/{id}', [FieldController::class, 'label']);
    Route::put('field/star/{id}', [FieldController::class, 'star']);
    Route::put('field/multiple/{id}', [FieldController::class, 'multiple']);
    Route::delete('form/{id}', [FormController::class, 'destroy']);
    Route::put('form/close/{id}', [FormController::class, 'close']);
    Route::put('form/close_by/{id}', [FormController::class, 'close_by']);
    Route::put('form/close_by_submission/{id}', [FormController::class, 'close_by_submission']);
    Route::post('formfieldresponse/{id}', [FormFieldResponseController::class, 'store']);
    Route::post('formfieldresponse/files/{id}', [FormFieldResponseController::class, 'fileUpload']);
    Route::delete('formfieldresponse/{id}/{fieldId}', [FormFieldResponseController::class, 'destroy']);
    Route::put('formresponse/complete', [FormResponseController::class, 'complete']);
    Route::post('responses/download/{id}', [FormResponseController::class, 'download']);
    Route::delete('responses/destroy', [FormResponseController::class, 'destroy']);
    Route::get('download/file_uploads/{id}', [DownloadController::class, 'fileUploads']);
    Route::post('utmfields/{id}', [UtmController::class, 'store']);
    Route::delete('utmfields/{id}', [UtmController::class, 'destroy']);
    Route::post('/utm-response/{id}', [UtmController::class, 'response']);
    Route::get('/subscription-checkout', function (Request $request) {
        return $request->user()
            ->newSubscription('prod_QtoXI3snwvM3H9', 'price_1Q20uCKy0dYEsuj84gazH5RT')
            ->checkout([
                'success_url' => route('dashboard'),
                'cancel_url' => route('dashboard'),
            ]);
    });
    Route::put('integrations/webhook/{id}', [IntegrationController::class, 'webhook']);
});