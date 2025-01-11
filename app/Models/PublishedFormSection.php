<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublishedFormSection extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['published_form_id', 'section_type_id', 'order', 'name', 'description', 'options', 'button_text', 'background_image', 'text_align'];

    public function publishedForm(): BelongsTo
    {
        return $this->belongsTo(PublishedForm::class);
    }

    public function section_type(): BelongsTo
    {
        return $this->belongsTo(SectionType::class);
    }

    public function publishedFormFields(): HasMany
    {
        return $this->hasMany(PublishedFormField::class);
    }

    public function publishedLogic(): HasMany
    {
        return $this->hasMany(PublishedLogic::class);
    }

    protected $casts = [
        'options' => 'array'
    ];
}
