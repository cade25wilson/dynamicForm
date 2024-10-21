<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\PublishedForm;
use App\Models\PublishedFormDesign;
use App\Models\PublishedFormField;
use App\Models\PublishedFormSection;
use App\PublishedFormHelper;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PublishFormController extends Controller
{
    use PublishedFormHelper;
    /**
     * Store a newly created resource in storage.
     */
    public function store(string $uuid)
    {
        DB::beginTransaction();
        try{
            PublishedForm::where('form_id', $uuid)->delete();
            
            $form = Form::with([
                'design',
                'sections.formFields'
            ])->find($uuid);

            $publishedForm = PublishedForm::create([
                'name' => $form->name,
                'description' => $form->description,
                'user_id' => $form->user_id,
                'form_id' => $form->id,
                'closed' => $form->closed,
                'close_by' => $form->close_by,
                'close_by_submission' => $form->close_by_submission
            ]);

            PublishedFormDesign::create([
                'id' => $form->design->id,
                'published_form_id' => $publishedForm->id,
                'background' => $form->design->background,
                'questions' => $form->design->questions,
                'answers' => $form->design->answers,
                'buttons' => $form->design->buttons,
                'button_text' => $form->design->button_text,
                'star_rating' => $form->design->star_rating,
                'font' => $form->design->font,
                'background_image' => $form->design->background_image,
                'logo' => $form->design->logo,
                'progress_bar' => $form->design->progress_bar,
                'captcha' => $form->design->captcha,
                'navigation' => $form->design->navigation

            ]);

            $sectionsData = [];
            $fieldsData = [];

            foreach ($form->sections as $section) {
                $sectionsData[] = [
                    'id' => $section->id,
                    'published_form_id' => $publishedForm->id,
                    'section_type_id' => $section->section_type_id,
                    'order' => $section->order,
                    'name' => $section->name,
                    'description' => $section->description,
                    'button_text' => $section->button_text,
                    'background_image' => $section->background_image,
                    'text_align' => $section->text_align,
                    'options' => $section->options,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                if ($section->formFields) {
                    foreach ($section->formFields as $field) {
                        $fieldsData[] = [
                            'id' => $field->id,
                            'label' => $field->label,
                            'placeholder' => $field->placeholder,
                            'type' => $field->type,
                            'required' => $field->required,
                            'order' => $field->order,
                            'show' => $field->show,
                            'options' => $field->options,
                            'published_form_section_id' => $section->id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }
            }

            PublishedFormSection::insert($sectionsData);

            if (!empty($fieldsData)) {
                PublishedFormField::insert($fieldsData);
            }

            DB::commit();
            return response()->noContent();
        } catch(Exception $e){
            DB::rollBack();
            Log::error($e);;
            return response()->json(['error' => 'Unable to create PublishedForm'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $form = $this->getCachedPublishedForm($id);
            $is_closed = $this->CheckIsClosed($form);
            $utmParameters = $this->GetUtmParameters($form->form_id);
            $formResponseId = $this->CreateFormResponse($is_closed, $id);
            $formSections = $this->getFormSections($form->id);
            return Inertia::render('PublishedForm', [
                'form' => $form,
                'form_sections' => $formSections,
                'response_id' => $formResponseId,
                'utm_parameters' => $utmParameters,
                'is_closed' => $is_closed
            ]);
        }catch(Exception $e){
            Log::error($e);
            return response()->json(['error' => 'Unable to fetch PublishedForm'], 500);
        }
    }
}
