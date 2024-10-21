<?php

// namespace App;

// use App\Models\FormResponses;
// use App\Models\FormUtmParameter;
// use App\Models\PublishedForm;
// use App\Models\PublishedFormSection;
// use Carbon\Carbon;
// use Illuminate\Support\Collection;
// use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Redis;
// use stdClass;

// trait PublishedFormHelper
// {
//     private function CreateFormResponse(bool $is_closed, string $id): mixed
//     {
//         if(!$is_closed){
//             $formResponse = FormResponses::create([
//                 'form_id' => $id
//             ]);
//         } else { 
//             $formResponse = new stdClass();
//             $formResponse->id = null;
//         }
//         return $formResponse->id;
//     }

//     private function getCachedPublishedForm($id)
//     {
//         // Define a unique cache key for the Published Form based on the form ID
//         $cacheKey = "published_form_{$id}";
    
//         // Use Cache::remember to check if the key exists, if not fetch and cache it
//         return Cache::remember($cacheKey, 60 * 60, function () use ($id) {
//             // Fetch the Published Form with its design relationship
//             return PublishedForm::where('form_id', $id)
//                 ->with('design')
//                 ->firstOrFail();
//         });
//     }

//     private function getFormSections($formId) {
//         $cacheKey = 'form_sections_' . $formId;
    
//         return Cache::remember($cacheKey, 60, function () use ($formId) {
//             // Fetch and transform form sections
//             $formSections = PublishedFormSection::where('published_form_id', $formId)
//                 ->join('section_types', 'published_form_sections.section_type_id', '=', 'section_types.id')
//                 ->select('published_form_sections.*', 'section_types.name as formsectionname')
//                 ->orderBy('published_form_sections.order')
//                 ->with(['publishedFormFields' => function ($query) {
//                     $query->orderBy('order', 'asc');
//                 }])
//                 ->get()
//                 ->map(function ($section) {
//                     // Decode section options if it's a string
//                     if (is_string($section->options)) {
//                         $section->options = json_decode($section->options, true);
//                     }
    
//                     // Rename publishedFormFields to form_fields
//                     $section->form_fields = $section->publishedFormFields;
//                     unset($section->publishedFormFields);
    
//                     // Decode options for each form field
//                     foreach ($section->form_fields as $field) {
//                         if (is_string($field->options)) {
//                             $field->options = json_decode($field->options, true);
//                         }
//                     }
    
//                     return $section;
//                 });
    
//             // Partition and reorder the sections
//             [$nonTypeTwo, $typeTwo] = $formSections->partition(function ($section) {
//                 return $section->section_type_id !== 2;
//             });
    
//             return $nonTypeTwo->merge($typeTwo);
//         });
//     }

//     private function GetUtmParameters(string $id): Collection
//     {
//         $cacheKey = "form_utm_parameters_{$id}";

//         return Cache::remember($cacheKey, 60 * 60, function () use ($id) {
//             return FormUtmParameter::where('form_id', $id)->pluck('utm_key');
//         });
//     }

//     private function CheckIsClosed(PublishedForm $form): bool
//     {
//         if($form->closed){
//             return true;
//         }

//         if ($form->close_by) {
//             if (Carbon::now()->isPast($form->close_by)) {
//                 return true;
//             }
//         }

//         if ($form->close_by_submissions){
//             $formResponses = FormResponses::where('form_id', $form->id)->count();
//             if ($formResponses >= $form->close_by_submissions){
//                 return true;
//             }
//         }
//         return false;
//     }
// }

namespace App;

use App\Models\FormResponses;
use App\Models\FormUtmParameter;
use App\Models\PublishedForm;
use App\Models\PublishedFormSection;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use stdClass;

trait PublishedFormHelper
{
    private function CreateFormResponse(bool $is_closed, string $id): mixed
    {
        if(!$is_closed){
            $formResponse = FormResponses::create([
                'form_id' => $id
            ]);
        } else { 
            $formResponse = new stdClass();
            $formResponse->id = null;
        }
        return $formResponse->id;
    }

    private function getPublishedForm($id)
    {
        // Fetch the Published Form with its design relationship directly
        return PublishedForm::where('form_id', $id)
            ->with('design')
            ->firstOrFail();
    }

    private function getFormSections($formId) {
        // Fetch and transform form sections directly from the database
        $formSections = PublishedFormSection::where('published_form_id', $formId)
            ->join('section_types', 'published_form_sections.section_type_id', '=', 'section_types.id')
            ->select('published_form_sections.*', 'section_types.name as formsectionname')
            ->orderBy('published_form_sections.order')
            ->with(['publishedFormFields' => function ($query) {
                $query->orderBy('order', 'asc');
            }])
            ->get()
            ->map(function ($section) {
                // Decode section options if it's a string
                if (is_string($section->options)) {
                    $section->options = json_decode($section->options, true);
                }

                // Rename publishedFormFields to form_fields
                $section->form_fields = $section->publishedFormFields;
                unset($section->publishedFormFields);

                // Decode options for each form field
                foreach ($section->form_fields as $field) {
                    if (is_string($field->options)) {
                        $field->options = json_decode($field->options, true);
                    }
                }

                return $section;
            });

        // Partition and reorder the sections
        [$nonTypeTwo, $typeTwo] = $formSections->partition(function ($section) {
            return $section->section_type_id !== 2;
        });

        return $nonTypeTwo->merge($typeTwo);
    }

    private function GetUtmParameters(string $id): Collection
    {
        // Fetch UTM parameters directly from the database
        return FormUtmParameter::where('form_id', $id)->pluck('utm_key');
    }

    private function CheckIsClosed(PublishedForm $form): bool
    {
        if($form->closed){
            return true;
        }

        if ($form->close_by && Carbon::now()->isPast($form->close_by)) {
            return true;
        }

        if ($form->close_by_submissions){
            $formResponses = FormResponses::where('form_id', $form->id)->count();
            if ($formResponses >= $form->close_by_submissions){
                return true;
            }
        }
        return false;
    }

    private function getCachedPublishedForm($id)
    {
        return PublishedForm::where('form_id', $id)
            ->with('design')
            ->firstOrFail();
    }
}
