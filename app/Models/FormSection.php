<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSection extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['form_id', 'section_type_id', 'order', 'name', 'description', 'options', 'button_text'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function section_type()
    {
        return $this->belongsTo(SectionType::class);
    }

    public function formFields()
    {
        return $this->hasMany(FormFields::class);
    }

    protected $casts = [
        'options' => 'array', // Casts the options attribute as an array
    ];
}
