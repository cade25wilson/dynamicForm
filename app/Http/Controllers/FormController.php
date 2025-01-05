<?php

namespace App\Http\Controllers;

use App\Models\EmailSettings;
use App\Models\Form;
use App\Models\FormDesign;
use App\Models\FormIntegrations;
use App\Models\FormSection;
use App\Models\FormUtmParameter;
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
    public function close(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'closed' => 'boolean|required'
            ]);
            Form::where('id', $id)->firstOrFail()->update([
                'closed' => $data['closed']
            ]);
            return response()->noContent();
        } catch(Exception $e){
            Log::error($e);
            return response(null,500);
        }
    }

    public function close_by(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'close_by' => 'date|nullable'
            ]);
            Form::where('id', $id)->firstOrFail()->update([
                'close_by' => $data['close_by']
            ]);
            return response()->noContent();
        } catch(Exception $e){
            Log::error($e);
            return response(null,500);
        }
    }
    
    public function close_by_submission(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'close_by_submission' => 'int|nullable'
            ]);
            Form::where('id', $id)->firstOrFail()->update([
                'close_by_submissions' => $data['close_by_submission']
            ]);
            return response()->noContent();
        } catch(Exception $e){
            Log::error($e);
            return response(null,500);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'formName' => 'required|string',
                'workSpace' => 'required|exists:workspaces,id'
            ]);

            DB::beginTransaction();
            $form = $this->CreateStarterForm($data);
            DB::commit();
            return redirect('/form/' . $form->id);
        } catch(Exception $e) {
            DB::rollBack();
            Log::error("error " . $e);
            return redirect('/dashboard');
        }
    }

    public function show(string $uuid)
    {
        $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();
        $section = request()->query('section');
        $form = Form::where('id', $uuid)
                ->with('design') 
                ->with('emailSettings')
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
                if($formField->options){
                    $formField->options = json_decode($formField->options, true);
                }
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

        $formSection = FormSection::where('section_type_id', 3)->with('formFields')->get();

        $formFields = $formSection->flatMap(function ($formSection) {
            return $formSection->formFields()
                ->where('type', 'email')
                ->where('show', 'true')
                ->select('label', 'id')
                ->get();
        });
        
                    
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

        $utmParameters = FormUtmParameter::where('form_id', $form->id)->pluck('utm_key');
        $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();

        return Inertia::render('Form', [
            'form' => $form,
            'form_sections' => $formSections,
            'groupedSectionTypes' => $groupedSectionTypes,
            'current_section' => $currentSection,
            'has_published_form' => $hasPublishedForm,
            'utm_parameters' => $utmParameters,
            'isPro' => $isPro,
            'has_email_block' => $formFields
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Form::destroy($id);
            return response()->noContent();
        }catch(Exception $e){
            Log::error($e);
            return response(null,500);
        }
    }

    public function update(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'name' => 'string|required'
            ]);
            Form::findOrFail($id)->update(['name' => $data['name']]);
            return response()->noContent();
        } catch (Exception $e){
            Log::error($e);
            return response(null, 500);
        }
    }

    public function connect(string $id)
    {
        try{
            $form = Form::where('id', $id)
                    ->with('formIntegration') 
                    ->firstOrFail();
            $hasPublishedForm = PublishedForm::where('form_id', $id)->exists();
            $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();
            return Inertia::render('Connect', [
                'form' => $form,
                'has_published_form' => $hasPublishedForm,
                'isPro' => $isPro
            ]);
        }catch(Exception $e){
            Log::error($e);
        }
    }

    public function share(string $id)
    {
        try{
            $form = Form::findOrFail($id)->only(['id', 'name']);
            $hasPublishedForm = PublishedForm::where('form_id', $id)->exists();
            $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();
            return Inertia::render('Share', [
                'form' => $form,
                'has_published_form' => $hasPublishedForm,
                'isPro' => $isPro
            ]);
        }catch(Exception $e){
            Log::error($e);
        }
    }

    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        PRIVATE FUNCTIONS
    */////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    private function CreateStarterForm(array $data): mixed 
    {
        $form = $this->createForm($data);
        $this->CreateFormDesign($form->id);
        $this->CreateStarterFormSection($form->id);
        $this->AddUtmParameters($form->id);
        $this->CreateEmailSettings($form);
        $this->CreateFormIntegration($form->id);
        return $form;
    }

    private function CreateForm(array $data): mixed
    {
        return Form::create([
            'name' => $data['formName'],
            'user_id' => Auth::id(),
            'workspace_id' => $data['workSpace']
        ]);
    }

    private function CreateFormDesign(string $formId): void
    {
        FormDesign::create([
            'form_id' => $formId
        ]);
    }

    private function CreateStarterFormSection(string $formId): void
    {
        FormSection::create([
            'form_id' => $formId,
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
            'form_id' => $formId,
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
    }

    private function CreateFormIntegration(string $formId)
    {
        FormIntegrations::create([
            'form_id' => $formId
        ]);
    }

    private function CreateEmailSettings(Form $form): void
    {
        EmailSettings::create([
            'form_id' => $form->id,
            'send_to' => Auth::user()->email,
            'subject' => '🎉 You received a new submission in' . $form->name,
        ]);
    }

    private function AddUtmParameters(string $formId): void 
    {
        $utmKeys = ['utm_source', 'utm_term', 'utm_content', 'utm_medium', 'utm_campaign', 'email'];
        $utmData = [];
        foreach ($utmKeys as $utmKey){
            $utmData[] = [
                'form_id' => $formId,
                'utm_key' => $utmKey,
                'created_at' => now(),
                'updated_at' => now()
            ];            
        }
        FormUtmParameter::insert($utmData);
    }
}