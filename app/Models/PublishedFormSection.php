<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedFormSection extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['published_form_id', 'section_type_id', 'order', 'name', 'description', 'options', 'button_text', 'background_image', 'text_align'];

    public function publishedForm()
    {
        return $this->belongsTo(PublishedForm::class);
    }

    public function section_type()
    {
        return $this->belongsTo(SectionType::class);
    }

    public function fields()
    {
        return $this->hasMany(PublishedFormField::class);
    }

    protected $casts = [
        'options' => 'array', // Casts the options attribute as an array
    ];
}
