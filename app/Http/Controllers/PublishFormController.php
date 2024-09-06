<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\PublishedForm;
use App\Models\PublishedFormDesign;
use App\Models\PublishedFormField;
use App\Models\PublishedFormSection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PublishFormController extends Controller
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
    public function create(string $uuid)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $uuid)
    {
        DB::beginTransaction();
        try{
            PublishedForm::where('form_id', $uuid)->delete();
            
            $form = Form::with([
                'design', // Load the form design
                'sections.formFields' // Load all sections with their corresponding fields
            ])->find($uuid);

            $publishedForm = PublishedForm::create([
                'name' => $form->name,
                'description' => $form->description,
                'user_id' => $form->user_id,
                'form_id' => $form->id
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
                'logo' => $form->design->logo
            ]);

            // foreach ($form->sections as $section) {
            //     $publishedSection = PublishedFormSection::create([
            //         'id' => $section->id,
            //         'published_form_id' => $publishedForm->id,
            //         'section_type_id' => $section->section_type_id,
            //         'order' => $section->order,
            //         'name' => $section->name,
            //         'description' => $section->description,
            //         'button_text' => $section->button_text,
            //         'background_image' => $section->background_image,
            //         'text_align' => $section->text_align,
            //         'options' => $section->options,
            //     ]);
        
            //     if ($section->formFields) {
            //         foreach ($section->formFields as $field) {
            //             PublishedFormField::create([
            //                 'id' => $field->id,
            //                 'label' => $field->label,
            //                 'placeholder' => $field->placeholder,
            //                 'type' => $field->type,
            //                 'required' => $field->required,
            //                 'order' => $field->order,
            //                 'show' => $field->show,
            //                 'options' => $field->options,
            //                 'published_form_section_id' => $publishedSection->id // Reference to the newly created section
            //             ]);
            //         }
            //     }
            // }

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
                'created_at' => now(), // If your table requires timestamps
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
                        'created_at' => now(), // If your table requires timestamps
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
            Log::info($e);
        }
        
        return $form;
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
