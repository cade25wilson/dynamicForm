<?php

namespace App\Http\Controllers;

use App\Models\FormFields;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FieldController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'label' => 'nullable|string',
                'placeholder' => 'nullable|string',
                'show' => 'required|boolean',
                'required' => 'required|boolean',
            ]);

            FormFields::where('id', $id)->firstOrFail()->update($data);
            return;
        } catch(Exception $e){
            Log::error($e);;
        }
    }

    public function maxlength(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'length' => 'numeric|nullable'
            ]);
            if($data['length'] === NULL){
                $data['length'] = "";
            }
            // Find the form field by ID
            $formField = FormFields::where('id', $id)->firstOrFail();
            $options = json_decode($formField->options, true);
            $options['length'] = $data['length']; // Replace $newLength with your desired value
            $formField->options = json_encode($options);
            $formField->save();
            return;
        } catch(Exception $e){
            Log::error($e);;
            return;
        }
    }
    public function option(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'string|required'
        ]);
    
        $formField = FormFields::where('id', $id)->firstOrFail();
        $options = json_decode($formField->options, true);
    
        // Prepare the new choice with label and null image
        $newChoice = [
            'label' => $data['name'],
            'image' => null,
        ];
    
        if (isset($options['choices']) && is_array($options['choices'])) {
            $options['choices'][] = $newChoice; // Add the new choice with label and null image
        } else {
            $options['choices'] = [$newChoice]; // Initialize choices array if not set
        }
    
        $formField->options = json_encode($options);
        $formField->save();
    
        return;
    }
    

    public function bulkoption(Request $request, string $id)
    {
        $data = $request->validate([
            'items' => 'array|required'
        ]);
    
        $formField = FormFields::where('id', $id)->firstOrFail();
        $options = json_decode($formField->options, true);
    
        // Prepare the new choices array with label and null image
        $newChoices = array_map(function($item) {
            return [
                'label' => $item,
                'image' => null
            ];
        }, $data['items']);
    
        // Merge the items into the existing choices
        if (isset($options['choices']) && is_array($options['choices'])) {
            $options['choices'] = array_merge($options['choices'], $newChoices);
        } else {
            $options['choices'] = $newChoices;
        }
    
        // Save the updated options back to the database
        $formField->options = json_encode($options);
        $formField->save();
    }
    
    
    public function updateoption(Request $request, string $id)
    {
        try{
            // Validate the request data
            $data = $request->validate([
                'index' => 'numeric|required',
                'value' => 'string|required'
            ]);

            // Find the form field by ID
            $formField = FormFields::where('id', $id)->firstOrFail();

            // Decode the JSON options column
            $options = json_decode($formField->options, true);

            // Check if choices key exists and is an array
            if (isset($options['choices']) && is_array($options['choices'])) {
                // Update the item at the given index
                $index = $data['index'];
                $value = $data['value'];

                // Check if index is within bounds
                if (isset($options['choices'][$index])) {
                    $options['choices'][$index]['label'] = $value;
                } else {
                    // Handle the case where the index is out of bounds
                    return response()->json(['error' => 'Index out of bounds'], 400);
                }

                // Encode the updated options array back to JSON
                $formField->options = json_encode($options);

                // Save the updated form field
                $formField->save();

                return;
            } else {
                return response()->json(['error' => 'Choices array not found'], 400);
            }
        }catch(Exception $e){
            Log::error($e);;
        }
    }

    public function addimage(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'image' => 'File|required',
                'index' => 'Numeric|required'
            ]);
            $formField = FormFields::where('id', $id)->firstOrFail();

            $options = json_decode($formField->options, true);

            $file = $request->file('image');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = "{$originalName}-{$id}.{$extension}";

            $file->move(public_path('option'), $filename);
            $background_image = "/option/{$filename}";

            $options['choices'][$data['index']]['image'] = $background_image;
            $formField->options = json_encode($options);
            $formField->save();
            return;
        }catch(Exception $e){
            Log::error($e);;
        }
    }

    public function addimagelink(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'image' => 'URL|required',
                'index' => 'Numeric|required'
            ]);
            $formField = FormFields::where('id', $id)->firstOrFail();

            $options = json_decode($formField->options, true);

            $options['choices'][$data['index']]['image'] = $data['image'];
            $formField->options = json_encode($options);
            $formField->save();
            return;
        }catch(Exception $e){
            Log::error($e);;
        }
    }

    public function removeimage(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'index' => 'Numeric|required'
            ]);
            $formField = FormFields::where('id', $id)->firstOrFail();
            $options = json_decode($formField->options, true);
            $options['choices'][$data['index']]['image'] = null;
            $formField->options = json_encode($options);
            $formField->save();
            return;
        }catch(Exception $e){
            Log::error($e);;
        }
    }

    public function deleteoption(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'index' => 'numeric|required'
            ]);

            $formField = FormFields::where('id', $id)->firstOrFail();

            $options = json_decode($formField->options, true);
            unset($options['choices'][$data['index']]);
            $options['choices'] = array_values($options['choices']);
            $formField->options = json_encode($options);
            $formField->save();
            
            return;
        }catch(Exception $e){
            Log::error($e);;
        }
    }

    public function align(Request $request, string $id)
    {
        $data = $request->validate([
            'align' => 'string|required|in:horizontal,vertical'
        ]);

        $formField = FormFields::where('id', $id)->firstOrFail();
        $options = json_decode($formField->options, true);
        $options['align'] = $data['align'];
        $formField->options = json_encode($options);
        $formField->save();
    }

    public function randomize(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'random' => 'Boolean|required'
            ]);

            $formField = FormFields::where('id', $id)->firstOrFail();
            $options = json_decode($formField->options, true);
            $options['random'] = $data['random'];
            $formField->options = json_encode($options);
            $formField->save();
        } catch(Exception $e){
            Log::error($e);;
        }
    }

    public function hidelabel(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'hide' => 'Boolean|required'
            ]);

            $formField = FormFields::where('id', $id)->firstOrFail();
            $options = json_decode($formField->options, true);
            $options['hide_label'] = $data['hide'];
            $formField->options = json_encode($options);
            $formField->save();
        } catch (Exception $e){
            Log::error($e);;
        }
    }

    public function scheduleprovider(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'schedule_provider' => 'string|in:Calendly,Cal.com,SavvyCal'
            ]);

            $formField = FormFields::where('id', $id)->firstOrFail();
            $options = json_decode($formField->options, true);
            $options['schedule_provider'] = $data['schedule_provider'];
            $formField->options = json_encode($options);
            $formField->save();
        } catch(Exception $e){
            Log::error($e);;
        }
    }

    public function label(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'label' => 'string|required'
            ]);

            $formField = FormFields::where('id', $id)->firstOrFail();
            $formField->label = $data['label'];
            $formField->save();
        } catch(Exception $e){
            Log::error($e);;
        }    
    }

    public function star(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'number_stars' => 'numeric|min:3|max:10',
            ]);
            
            $formField = FormFields::where('id', $id)->firstOrFail();
            $options = json_decode($formField->options, true);
            $options['number_stars'] = $data['number_stars'];
            $formField->options = json_encode($options);
            $formField->save();
        } catch(Exception $e){
            Log::error($e);;
        }
    }

    public function multiple(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'multiple' => 'boolean|required',
            ]);

            $formField = FormFields::where('id', $id)->firstOrFail();
            $options = json_decode($formField->options, true);
            $options['multiple'] = $data['multiple'];
            $formField->options = json_encode($options);
            $formField->save();
        } catch(Exception $e){
            Log::error($e);;
        }
    }

    public function schedulelink(Request $request, string $id)
    {
        try{
            $data = $request->validate([
                'schedule_link' => 'URL|required'
            ]);

            $formField = FormFields::where('id', $id)->firstOrFail();
            $options = json_decode($formField->options, true);
            $options['schedule_link'] = $data['schedule_link'];
            $formField->options = json_encode($options);
            $formField->save();
        } catch(Exception $e){
            Log::error($e);;
        }
    }
}
