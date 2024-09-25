<?php

namespace App\Http\Controllers;

use App\Models\FormFields;
use App\Models\FormSection;
use App\Models\SectionType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (!in_array($data['SectionId'], [1, 2])) {
            $order = FormSection::where('form_id', $data['FormId'])->orderBy('order', 'desc')->first();
            $order = $order->order + 1;
        }        
        
        $type = SectionType::where('id', $data['SectionId'])->first();
        $color = $this->getColor($data['SectionId']);
        $svg = $this->getSvg($data['SectionId']);
        $json = ['color' => $color, 'svg' => $svg];
        if ($data['SectionId'] == 2) {
            $json = array_merge($json, [
                'end' => 'button',
                'button_link' => 'https://buildmyform.com/',
                'redirect_url' => 'https://buildmyform.com/',
                'redirect_message' => 'You will be redirected momentarily.',
                'redirect_delay' => 3
            ]);
        }

        $textAlign = $this->getTextAlign($data['SectionId']);
        $section = FormSection::create([
            'form_id' => $data['FormId'],
            'section_type_id' => $data['SectionId'],
            'order' => $order,
            'options' => json_encode(['color' => $color, 'svg' => $svg, 'end' => 'button', 'button_link' => 'https://buildmyform.com/', 'redirect_url' => 'https://buildmyform.com/', 'redirect_message' => 'You will be redirected momentarily.', 'redirect_delay' => 3]),
            'name' => $type->default_name,
            'text_align' => $textAlign
        ]);

        $this->generateFormFields($section->id, $type);
        return redirect('/form/' . $data['FormId'] . '?section=' . $section->id);
    }

    private function getColor($id){
        switch ($id) {
            case 1:
                $color = "pink";
                break;
            case 2:
                $color = "blue";
                break;
            case 3:
                $color = "yellow";
                break;
            case 4:
                $color = "violet";
                break;
            case 5:
                $color = "pink";
                break;
            case 6:
                $color = "#FFBF00";
                break;
            case 7:
                $color = "#14B8A6";
                break;
            case 8:
                $color = "green";
                break;
            case 9:
                $color = "red";
                break;
            case 10:
                $color = "purple";
                break;
            case 11:
                $color = "#2DD4BF";
                break;
            case 12:
                $color = "indigo";
                break;
            case 13:
                $color = "#C07C78";
                break;
            case 14:
                $color = "cyan";
                break;
            case 15:
                $color = "#F59E0B";
                break;
            default:
                $color = "#F59E0B";
                break;
        }    
        return $color;
    }

    private function getSvg($id){
        switch ($id) {
            case 1:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>';
                break;
            case 2:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5"></path></svg>';
                break;
            case 3:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5"></path></svg>';
                break;
            case 4:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"></path></svg>';
                break;
            case 5:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>';
                break;
            case 6:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5"></path></svg>';
                break;
            case 7:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"></path></svg>';
                break;
            case 8:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z"></path></svg>';
                break;
            case 9:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>';
                break;
            case 10:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25"></path></svg>';
                break;
            case 11:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"></path></svg>';
                break;
            case 12:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path></svg>';
                break;
            case 13:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path></svg>';
                break;
            case 14:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 -mr-1 -ml-1" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><path d="M24.2,71.7c0-0.1,4.3-11.4,10.1-22.1C41,37,47.3,30,51.1,31.2c0.4,0.1,0.6,0.3,0.8,0.6c1.4,2.7-1.5,10.9-3.7,17.5  c-2.9,8.5-5.7,16.5-3.5,20.9c0.7,1.4,1.8,2.4,3.3,2.8c0.5,0.2,1,0.2,1.4,0.2c4.1,0,6.4-6.1,8.6-12c1-2.7,2.1-5.5,3.2-7.4  c0.6-1.1,1.1-1.6,1.4-1.7c0.1,1.1-0.5,3.8-0.9,5.4c-1,4.2-2,8.3,0.3,10.5c3,2.9,12.4,1.4,16.3,0.6c1.2-0.2,1.9-1.4,1.7-2.5  c-0.2-1.2-1.4-1.9-2.5-1.7c-5.5,1.1-11.4,1.4-12.5,0.6c-0.5-0.8,0.4-4.6,0.9-6.5c1.1-4.4,2.3-9.4-1.7-10.6c-5-1.5-7.6,5.2-10.1,11.8  c-0.9,2.5-1.9,5-2.9,6.9c-1.2,2.2-1.8,2.3-1.8,2.3c0,0,0,0-0.1,0c-0.4-0.1-0.6-0.3-0.8-0.7c-1.4-2.8,1.5-11,3.8-17.6  c3.1-8.9,5.7-16.5,3.5-20.8c-0.7-1.4-1.9-2.3-3.4-2.8c-6.3-1.9-13.4,4.9-21.8,20.6c-5.8,10.9-10.2,22.4-10.3,22.5  c-0.4,1.1,0.1,2.3,1.2,2.8C22.5,73.4,23.8,72.8,24.2,71.7z"></path></svg>';
                break;
            case 15:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15"></path></svg>';
                break;
            default:
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15"></path></svg>'; 
                break;
        }    
        return $svg;
    }
    
    private function getTextAlign($id){
        switch ($id) {
            case 1:
                $textAlign = "center";
                break;
            case 2:
                $textAlign = "center";
                break;
            case 3:
                $textAlign = "left";
                break;
            case 4:
                $textAlign = "left";
                break;
            case 5:
                $textAlign = "left";
                break;
            case 6:
                $textAlign = "left";
                break;
            case 7:
                $textAlign = "left";
                break;
            case 8:
                $textAlign = "left";
                break;
            case 9:
                $textAlign = "left";
                break;
            case 10:
                $textAlign = "left";
                break;
            case 11:
                $textAlign = "left";
                break;
            case 12:
                $textAlign = "left";
                break;
            case 13:
                $textAlign = "left";
                break;
            case 14:
                $textAlign = "left";
                break;
            case 15:
                $textAlign = "left";
                break;
            case 16:
                $textAlign = "left";
                break;
            default:
                $textAlign = "left";
                break;
        }    
        return $textAlign;
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
        try{
            Log::info($request);
            $validatedData = $request->validate([
                // 'button_text' => 'string|required',
                // 'name' => 'string|nullable',
                // 'description' => 'string|nullable',
                // 'text_align' => 'string|required',
                'embed' => 'nullable|url'
            ]);

            // if (!$validatedData['embed']){
            //     FormSection::where('id', $id)->firstOrFail()->update([
            //         'button_text' => $validatedData['button_text'],
            //         'name' => $validatedData['name'],
            //         'description' => $validatedData['description'],
            //         'text_align' => $validatedData['text_align'],
            //     ]);
            //     return;
            // }
            $formSection = FormSection::where('id', $id)->firstOrFail();
            $options = json_decode($formSection->options, true);
            $options['embed'] = $validatedData['embed'];
            $options = json_encode($options);
            $formSection->update([
                // 'button_text' => $validatedData['button_text'],
                // 'name' => $validatedData['name'],
                // 'description' => $validatedData['description'],
                // 'text_align' => $validatedData['text_align'],
                'options' => $options
            ]);

            return;
        } catch(Exception $e){
            Log::info($e);
        }
    }

    public function backgroundImage(string $id, Request $request)
    {
        $request->validate([
            'background_image' => 'nullable|file'
        ]);
        
        $background_image = null;
        if($request->file('background_image')){
            $file = $request->file('background_image');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = "{$originalName}-{$id}.{$extension}";

            $file->move(public_path('cover_images'), $filename);
            $background_image = "/cover_images/{$filename}";
        }

        FormSection::where('id', $id)->firstOrFail()->update([
            'background_image' => $background_image
        ]);        
    }

    public function singleField(Request $request, string $id)
    {
        try{
            Log::info($request);
            $fillableColumns = (new FormSection)->getFillable();
            $data = $request->validate([
                'input' => 'required|in:' . implode(',', $fillableColumns),
                'value' => 'nullable'
            ]);

            FormSection::where('id', $id)->firstOrFail()->update([
                $data['input'] => $data['value']
            ]);

            return;
        }catch(Exception $e){
            Log::info($e);
        }
    }

    public function updateEnding(Request $request, string $id)
    {
        $data = $request->validate([
            'jsonKey' => 'required|string',
            'value' => 'required'
        ]);

        $formSection = FormSection::findOrFail($id);

        $options = json_decode($formSection->options, true);

        $options[$data['jsonKey']] = $data['value'];

        $formSection->update([
            'options' => json_encode($options)
        ]);
        

        return response()->json(['message' => 'Options updated successfully.']);
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
            $isPro = User::where('id', Auth::id())->firstOrFail()->isPro();
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
                'error' => $e->getMessage(),
                'isPro' => $isPro
            ]);
        }
        return redirect('form/' . $formSection ->form_id);
    }

    private function duplicateFormSection(FormSection $formSection, int $newOrder): FormSection
    {
        return FormSection::create([
            'form_id' => $formSection->form_id,
            'section_type_id' => $formSection->section_type_id,
            'order' => $newOrder,
            'name' => $formSection->name,
            'description' => $formSection->description,
            'options' => $formSection->options,
            'text_align' => $formSection->text_align
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
                FormFields::create(['label' => 'Last Name','type' => 'text','order' => 2,'form_section_id' => $sectionId]);
                FormFields::create(['label' => 'Email','type' => 'email','order' => 3,'form_section_id' => $sectionId]);
                FormFields::create(['label' => 'Phone Number','type' => 'tel','order' => 4,'form_section_id' => $sectionId]);
                FormFields::create(['label' => 'Company','type' => 'text','order' => 5,'form_section_id' => $sectionId]);
                break;
            case 4:
                FormFields::create(['label' => 'Short Text', 'type' => 'text','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 5:
                FormFields::create(['label' => 'Long Text', 'type' => 'textarea','order' => 1,'form_section_id' => $sectionId, 'options' => json_encode(['length' => 0])]);
                break;
            case 6:
                FormFields::create(['label' => 'Phone Number', 'type' => 'tel','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 7:
                // FormFields::create([]);
                break;
            case 8:
                FormFields::create(['label' => 'Single Select Option', 'type' => 'option','order' => 1,'form_section_id' => $sectionId,'options' => json_encode(['choices' => [['label' => 'option 1', 'image' => null],['label' => 'option 2', 'image' => null]],'align' => 'horizontal','random' => false, 'hide_label' => false])]);
                break;
            case 9:
                FormFields::create(['label' => 'Multi Select Option', 'type' => 'option','order' => 1,'form_section_id' => $sectionId,'options' => json_encode(['choices' => [['label' => 'option 1', 'image' => null],['label' => 'option 2', 'image' => null]],'align' => 'horizontal','random' => false, 'hide_label' => false])]);
                break;
            case 10:
                FormFields::create(['label' => 'Drop Down List', 'type' => 'select','order' => 1,'form_section_id' => $sectionId, 'options' => json_encode(['choices' => [['label' => 'option 1'], ['label' => 'option 2']], 'random' => false])]);
                break;
            case 11:
                FormFields::create(['label' => 'Date','type' => 'date','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 12:
                FormFields::create(['label' => 'Choose a slot', 'type' => 'date', 'order' => 1, 'form_section_id' => $sectionId, 'options' => json_encode(['schedule_provider' => 'calendly', 'schedule_link' => null])]);
                break;
            case 13:
                FormFields::create(['label' => 'Star Rating','type' => 'rating', 'order' => 1, 'form_section_id' => $sectionId, 'options' => json_encode(['number_stars' => 5])]);
                break;
            case 14:
                FormFields::create(['label' => 'Opinion Scale', 'type' => 'Scale','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 15:
                FormFields::create(['label' => 'Signature','type' => 'canvas','order' => 1,'form_section_id' => $sectionId]);
                break;
            case 16:
                FormFields::create(['label' => 'File Upload','type' => 'file','order' => 1,'form_section_id' => $sectionId, 'options' => json_encode(['multiple' => false])]);
                break;
            default:
                echo "Type ID is not within the range of 0 to 16";
                break;
        }        
    }
}
