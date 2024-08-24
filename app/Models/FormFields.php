<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormFields extends Model
{
    use HasUuids;
    // The attributes that are mass assignable.
    // protected $fillable = ['form_id', 'label', 'type', 'required', 'order', 'options', 'form_section_id'];
    protected $fillable = ['label', 'type', 'required', 'order', 'options', 'form_section_id'];

    // Define the relationship with the Form model
    // public function form()
    // {
    //     return $this->belongsTo(Form::class);
    // }

    public function formSection()
    {
        return $this->belongsTo(FormSection::class);
    }

    // Define the relationship with the FormFieldResponse model
    public function responses()
    {
        return $this->hasMany(FormFieldResponses::class);
    }
}
