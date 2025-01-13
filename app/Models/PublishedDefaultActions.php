<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublishedDefaultActions extends Model
{
    protected $fillable = ['published_form_section_id', 'type', 'target'];

    public function formSection(): BelongsTo
    {
        return $this->belongsTo(PublishedFormSection::class);
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(PublishedFormSection::class);
    }
}
