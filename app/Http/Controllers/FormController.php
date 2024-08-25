<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormDesign;
use App\Models\FormSection;
use App\Models\SectionCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class FormController extends Controller
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
    public function create()
    {
        //
    }

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
                ]),
            ]);
            

            FormSection::create([
                'form_id' => $form->id,
                'section_type_id' => 2,
                'name' => 'Thank you! 🙌',
                'order' => 0,
                'description' => "That's all. You may now close this window.",
                "button_text" => "exit",
                'text_align' => 'center',
                'options' => json_encode([
                    'embed' => null,
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

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $section = request()->query('section');
        $form = Form::where('id', $uuid)
                ->with('design') 
                ->firstOrFail();

        if($section){
            $currentSection = FormSection::with('formFields')->find($section);
        } else{
            $currentSection = FormSection::where('form_id', $form->id)
            ->orderBy('order')
            ->with('formFields')
            ->first();
        }
        $formSections = FormSection::where('form_id', $uuid)
            ->join('section_types', 'form_sections.section_type_id', '=', 'section_types.id')
            ->select('form_sections.*', 'section_types.name as formsectionname') // Select only the necessary columns
            ->orderBy('form_sections.order')
            ->get();

        $sectionCategories = SectionCategory::with(['sectionTypes' => function ($query) {
            $query->where('show', true)->select('id', 'name', 'section_category_id');
        }])->get();
        
        $groupedSectionTypes = $sectionCategories->map(function ($category) {
            return [
                'category_name' => $category->name,
                'section_types' => $category->sectionTypes,
            ];
        });

        return Inertia::render('Form', [
            'form' => $form,
            'form_sections' => $formSections,
            'groupedSectionTypes' => $groupedSectionTypes,
            'current_section' => $currentSection
        ]);
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
