<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormDesign;
use App\Models\FormSection;
use App\Models\PublishedForm;
use App\Models\SectionCategory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class FormController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'formName' => 'required|string'
        ]);

        DB::beginTransaction();
        try{
            $form = Form::create([
                'name' => $data['formName'],
                'user_id' => Auth::id()
            ]);

            FormDesign::create([
                'form_id' =>$form->id
            ]);

            FormSection::create([
                'form_id' => $form->id,
                'section_type_id' => 1,
                'name' => 'Hey there 😀',
                'description' => 'Mind filling out this form?',
                'button_text' => 'Start',
                'text_align' => 'center',
                'options' => json_encode([
                    'embed' => null,
                    'color' => 'pink',
                    'svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>'
                ]),
            ]);

            FormSection::create([
                'form_id' => $form->id,
                'section_type_id' => 2,
                'name' => 'Thank you! 🙌',
                'order' => 0,
                'description' => "That's all. You may now close this window.",
                "button_text" => "Create your own Form",
                'text_align' => 'center',
                'options' => json_encode([
                    'embed' => null,
                    'color' => 'pink',
                    'end' => 'button',
                    'button_link' => 'https://buildmyform.com/',
                    'redirect_url' => 'https://buildmyform.com/',
                    'redirect_message' => 'You will be redirected momentarily.',
                    'redirect_delay' => 3
                ]),
            ]);
            
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            Log::info("error " . $e);
            return redirect('/dashboard');
        }

        return redirect('/form/' . $form->id);
    }

    public function show(string $uuid)
    {
        $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();
        $section = request()->query('section');
        $form = Form::where('id', $uuid)
                ->with('design') 
                ->firstOrFail();

        if ($section) {
            $currentSection = FormSection::with(['formFields' => function ($query) {
                $query->orderBy('order');
            }])->find($section);
        } else {
            $currentSection = FormSection::where('form_id', $form->id)
                ->where('order', '!=', 0)
                ->orderBy('order')
                ->with(['formFields' => function ($query) {
                    $query->orderBy('order', 'asc');
                }])
                ->first();
        }

        if ($currentSection) {
            $currentSection->options = json_decode($currentSection->options, true);
            foreach ($currentSection->formFields as $formField) {
                $formField->options = json_decode($formField->options, true);
            }
        }
        // Your original query
        $formSections = FormSection::where('form_id', $uuid)
                    ->join('section_types', 'form_sections.section_type_id', '=', 'section_types.id')
                    ->select('form_sections.*', 'section_types.name as formsectionname')
                    ->orderBy('form_sections.order')
                    ->get()
                    ->map(function ($section) {
                        $section->options = json_decode($section->options, true);
                        return $section;
                    });

        $sectionCategories = SectionCategory::with(['sectionTypes' => function ($query) {
            $query->where('show', true)->select('id', 'name', 'section_category_id');
        }])->get();

        $hasPublishedForm = PublishedForm::where('form_id', $uuid)->exists();

        $groupedSectionTypes = $sectionCategories
            ->filter(function ($category) {
                return $category->name !== 'Null';
            })
            ->map(function ($category) {
                return [
                    'category_name' => $category->name,
                    'section_types' => $category->sectionTypes,
                ];
            });

        $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();

        return Inertia::render('Form', [
            'form' => $form,
            'form_sections' => $formSections,
            'groupedSectionTypes' => $groupedSectionTypes,
            'current_section' => $currentSection,
            'has_published_form' => $hasPublishedForm,
            'isPro' => $isPro
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Form::destroy($id);
            return;
        }catch(Exception $e){
            Log::error($e);;
        }
    }
}
