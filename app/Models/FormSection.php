<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSection extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['form_id', 'section_type_id', 'order', 'name', 'description', 'options'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function section_type()
    {
        return $this->belongsTo(SectionType::class);
    }
}
