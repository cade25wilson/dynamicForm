<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DefaultAction extends Model
{
    protected $fillable = ['form_section_id', 'type', 'target'];

    public function formSection(): BelongsTo
    {
        return $this->belongsTo(FormSection::class);
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(FormSection::class);
    }
}
