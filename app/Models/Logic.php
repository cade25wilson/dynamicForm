<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logic extends Model
{
    protected $fillable = ['form_section_id', 'condition', 'action', 'default_action'];

    protected $casts = [
        'condition' => 'array',
        'action' => 'array',
        'default_action' => 'array'
    ];

    public function formSection(): BelongsTo
    {
        return $this->belongsTo(FormSection::class);
    }
}