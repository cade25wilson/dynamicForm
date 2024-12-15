<?php

namespace App\Jobs;

use App\Mail\CompleteFormMail;
use App\Models\Form;
use App\Models\FormFieldResponses;
use App\Models\PublishedForm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FormCompletion implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new job instance.
     */
    public function __construct(protected string $formId, protected string $responseId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
    $formId = PublishedForm::where('id', $this->formId)->pluck('form_id')->first();
        $form = Form::where('id', $formId)
                ->with('formIntegration') 
                ->firstOrFail();
        $webhookUrl = $form->formIntegration->webhook;
        $form = Form::with(['publishedForm.sections.publishedFormFields'])->findOrFail($formId);
        $sections = $form->publishedForm->sections;

        $responseData = [];

        foreach ($sections as $section) {
            if ($section->publishedFormFields->isEmpty()) {
                continue;
            }
        
            $sectionName = $section->name;        
            $fieldsData = [];        
            $fields = $section->publishedFormFields;
        
            if ($fields) {
                foreach ($fields as $field) {
                    $fieldName = $field->label;
        
                    $value = FormFieldResponses::where('response_id', $this->responseId)
                        ->where('form_field_id', $field->id)
                        ->value('value');
        
                    $fieldsData[$fieldName] = $value;
                }
            }
            $responseData[$sectionName] = $fieldsData;
        }        

        Log::info(json_encode($responseData));

        if($webhookUrl){
            Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($webhookUrl, $responseData);
        }

        Mail::to($form->user->email)->send(new CompleteFormMail($responseData, $form));
    }
}
