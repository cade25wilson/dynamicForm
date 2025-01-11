<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormSection extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['form_id', 'section_type_id', 'order', 'name', 'description', 'options', 'button_text', 'background_image', 'text_align'];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function section_type(): BelongsTo
    {
        return $this->belongsTo(SectionType::class);
    }

    public function formFields(): HasMany
    {
        return $this->hasMany(FormFields::class);
    }

    public function logic(): HasMany
    {
        return $this->hasMany(Logic::class);
    }

    protected $casts = [
        'options' => 'array',
    ];
}
