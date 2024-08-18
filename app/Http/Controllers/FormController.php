<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormFields;
use App\Models\FormSection;
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

            FormSection::create([
                'form_id' => $form->id,
                'section_type_id' => 1,
                'name' => 'Hey there 😀',
                'description' => 'Mind filling out this form?'
            ]);

            FormSection::create([
                'form_id' => $form->id,
                'section_type_id' => 2,
                'name' => 'Thank you! 🙌',
                'order' => 0,
                'description' => "That's all. You may now close this window."
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
        $form = Form::where('forms.id', $uuid)
                ->leftJoin('form_designs', 'forms.id', '=', 'form_designs.form_id')
                ->first();
        $formFields = FormFields::where('form_id', $form->id)->orderBy('order')->get();
        $formSections = FormSection::where('form_id', $uuid)->orderBy('order')->get();
        $data = [
            'form' => $form,
            'formFields' => $formFields,
            'form_sections' => $formSections,
        ];
        return Inertia::render('Form', [
            'data' => $data
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
