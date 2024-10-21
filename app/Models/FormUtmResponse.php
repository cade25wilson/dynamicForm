<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormUtmResponse extends Model
{
    use HasFactory;
    
    protected $fillable = ['form_utm_parameters', 'utm_value', 'form_responses_id'];

    public function utmParameter(): BelongsTo
    {
        return $this->belongsTo(FormUtmParameter::class, 'form_utm_parameters');
    }

    public function responseId(): BelongsTo
    {
        return $this->belongsTo(FormResponses::class);
    }
}
