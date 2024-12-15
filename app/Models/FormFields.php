<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FormFields extends Model
{
    use HasUuids;
    // The attributes that are mass assignable.
    protected $fillable = ['label', 'type', 'required', 'order', 'options', 'form_section_id', 'show', 'placeholder'];

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
