<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublishedLogic extends Model
{
    protected $fillable = ['published_form_section_id', 'is_always', 'condition', 'action', 'default_action'];

    protected $casts = [
        'condition' => 'array',
        'action' => 'array',
        'default_action' => 'array'
    ];

    public function publishedFormSection(): BelongsTo
    {
        return $this->belongsTo(PublishedFormSection::class);
    }
}
