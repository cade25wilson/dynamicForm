<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedFormField extends Model
{
    use HasUuids;
    // The attributes that are mass assignable.
    protected $fillable = ['label', 'type', 'required', 'order', 'options', 'published_form_section_id', 'show', 'placeholder'];

    public function publishedFormSection()
    {
        return $this->belongsTo(PublishedFormSection::class);
    }

    public function responses()
    {
        return $this->hasMany(FormFieldResponses::class);
    }
}
