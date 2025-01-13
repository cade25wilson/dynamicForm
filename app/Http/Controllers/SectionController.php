<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteBackgroundImage;
use App\Models\DefaultAction;
use App\Setup;
use App\Models\FormFields;
use App\Models\FormSection;
use App\Models\SectionType;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SectionController extends Controller
{
    use Setup;
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
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
                'options' => json_encode(['currency' => 'USD', 'amount' => 0, 'color' => $color, 'svg' => $svg, 'end' => 'button', 'button_link' => 'https://buildmyform.com/', 'redirect_url' => 'https://buildmyform.com/', 'redirect_message' => 'You will be redirected momentarily.', 'redirect_delay' => 3]),
                'name' => $type->default_name,
                'text_align' => $textAlign
            ]);

            DefaultAction::create([
                'form_section_id' => $section->id,
                'type' => 'goto'
            ]);

            $this->generateFormFields($section->id, $type);
            return redirect('/form/' . $data['FormId'] . '?section=' . $section->id);
        } catch(Exception $e){
            Log::error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $validatedData = $request->validate([
                'embed' => 'nullable|url'
            ]);

            $formSection = FormSection::where('id', $id)->firstOrFail();
            $options = json_decode($formSection->options, true);
            $options['embed'] = $validatedData['embed'];
            $options = json_encode($options);
            $formSection->update([
                'options' => $options
            ]);

            return;
        } catch(Exception $e){
            Log::error($e);;
        }
    }

    public function backgroundImage(string $id, Request $request)
    {
        try{
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
            return response(json_encode(['background_image' => $background_image]), 200);
        } catch (Exception $e){
            Log::error($e);
        }
    }

    public function removeBackgroundImage(string $id)
    {
        try {
            $formSection = FormSection::where('id', $id)->firstOrFail();
            $backgroundImagePath = $formSection->background_image;

            DeleteBackgroundImage::dispatch($backgroundImagePath);

            $formSection->update([
                'background_image' => null
            ]);

            return response()->noContent();
        } catch (Exception $e) {
            Log::error($e);
            return response(null, 500);
        }
    }


    public function singleField(Request $request, string $id)
    {
        try{
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
            Log::error($e);;
        }
    }

    public function updateEnding(Request $request, string $id)
    {
        try{
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
            return response(204);
        } catch(Exception $e){
            Log::error($e);
        }
    }


    public function duplicate(string $id)
    {
        try{
            $formSection = FormSection::where('id', $id)->with('defaultAction')->with('formFields')->firstOrFail();
            $newOrder = $formSection->order == 0 ? 1 : $formSection->order + 1;
        
            if ($formSection->order != 0) {
                FormSection::where('form_id', $formSection->form_id)
                    ->where('order', '>', $formSection->order)
                    ->increment('order');
            }

            $newFormSection = $this->duplicateFormSection($formSection, $newOrder);
            $this->duplicateFormFields($formSection->formFields, $formSection->form_id, $newFormSection->id);
            $this->duplicateSectionDefaultAction($newFormSection, $formSection->defaultAction);

            return redirect('form/' . $formSection->form_id);
        } catch(Exception $e){
            Log::error($e);
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

    public function payment(Request $request, string $id){
        try{
            $data = $request->validate([
                'type' => 'required|in:currency,amount',
                'value' => 'required'
            ]);

            $formSection = FormSection::where('id', $id)->firstOrFail();

            $options = json_decode($formSection->options, true);

            $options[$data['type']] = $data['value'];

            $formSection->update([
                'options' => json_encode($options)
            ]);

            return response()->noContent();
        } catch(Exception $e){
            Log::error($e);
            return response(null,500);
        }
    }
}
