<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormFields;
use App\Models\FormSection;
use App\Models\SectionType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SectionController extends Controller
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
            'SectionId' => 'required|exists:section_types,id',
            'FormId' => 'required|exists:forms,id',
        ]);

        $order = 0;
        if($data['SectionId'] != 1 || $data['SectionId'] != 2){
            $order = FormSection::where('form_id', $data['FormId'])->orderBy('order', 'desc')->first();
            $order = $order->order + 1;
        }
        
        $type = SectionType::where('id', $data['SectionId'])->first();
        $section = FormSection::create([
            'form_id' => $data['FormId'],
            'section_type_id' => $data['SectionId'],
            'order' => $order,
            'name' => $type->default_name,
        ]);

        $this->generateFormFields($section->id, $type);
        return redirect('/form/' . $data['FormId']);
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

    public function duplicate(string $id)
    {
        try{
            $formSection = FormSection::where('id', $id)->firstOrFail();
            $formFields = FormFields::where('form_section_id', $formSection->id)->get();
            $newOrder = $formSection->order == 0 ? 1 : $formSection->order + 1;
        
            if ($formSection->order != 0) {
                FormSection::where('form_id', $formSection->form_id)
                    ->where('order', '>', $formSection->order)
                    ->increment('order');
            }

            $newFormSection = $this->duplicateFormSection($formSection, $newOrder);
            $this->duplicateFormFields($formFields, $formSection->form_id, $newFormSection->id);

            return redirect('form/' . $formSection->form_id);
        } catch(Exception $e){
            return redirect('form/' . $formSection->form_id);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $formSection = FormSection::where('id', $id)->firstOrFail();
            $formId = $formSection->form_id;
            $formSection->delete();
    
            $formSections = FormSection::where('form_id', $formId)
                                        ->where('order', '!=', 0)
                                        ->orderBy('order')
                                        ->get();
    
            foreach ($formSections as $index => $section) {
                $section->order = $index + 1;
                $section->save();
            }
    
            return redirect('form/' . $formSection->form_id);
        } catch (Exception $e) {
            return Inertia::render('Form', [
                'error' => $e->getMessage()
            ]);
        }
    }
    
    private function duplicateFormSection(FormSection $formSection, int $newOrder): FormSection
    {
        return FormSection::create([
            'form_id' => $formSection->form_id,
            'section_type_id' => $formSection->section_type_id,
            'order' => $newOrder,
            'name' => $formSection->name,
            'description' => $formSection->description,
            'options' => $formSection->options
        ]);
    }

    private function duplicateFormFields(Collection $formFields, string $formId, string $formSectionId): void
    {
        foreach($formFields as $formField){
            FormFields::create([
                'form_id' => $formId,
                'label' => $formField->label,
                'type' => $formField->type,
                'required' => $formField->required,
                'order' => $formField->order,
                'options' => $formField->options,
                'form_section_id' => $formSectionId,
            ]);
        }
    }
    
    private function generateFormFields(string $sectionId, mixed $type): void
    {
        switch ($type->id) {
            case 1:
                break;
            case 2:
                break;
            case 3:
                FormFields::create(['label' => 'First Name','type' => 'text','order' => 1,'form_section_id' => $sectionId]);
                FormFields::create(['label' => 'Lase Name','type' => 'text','order' => 1,'form_section_id' => $sectionId]);
                FormFields::create(['label' => 'Email','type' => 'email','order' => 1,'form_section_id' => $sectionId]);
                FormFields::create(['label' => 'Phone Number','type' => 'tel','order' => 1,'form_section_id' => $sectionId]);
                FormFields::create(['label' => 'Company','type' => 'text','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 4:
                FormFields::create(['type' => 'text','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 5:
                FormFields::create(['type' => 'textarea','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 6:
                FormFields::create(['type' => 'tel','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 7:
                // FormFields::create([]);
                break;
            case 8:
                FormFields::create(['type' => 'option','order' => 1,'form_section_id' => $sectionId, 'options' => json_encode(['Option 1', 'Option 2'])]);
                break;
            case 9:
                FormFields::create(['type' => 'option','order' => 1,'form_section_id' => $sectionId, 'options' => json_encode(['Option 1', 'Option 2'])]);
                break;
            case 10:
                FormFields::create(['type' => 'select','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 11:
                FormFields::create(['label' => 'Date','type' => 'date','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 12:
                // FormFields::create([]);
                break;
            case 13:
                FormFields::create(['label' => 'Star Rating','type' => 'rating','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 14:
                FormFields::create(['type' => 'Scale','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 15:
                FormFields::create(['label' => 'Signature','type' => 'canvas','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 16:
                FormFields::create(['label' => 'File Upload','type' => 'file','order' => 1,'form_section_id' => $sectionId]);
                break;
            default:
                echo "Type ID is not within the range of 0 to 16";
                break;
        }        
    }
}
