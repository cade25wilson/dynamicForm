<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormUtmParameter extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'utm_key'];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function utmResponses(): HasMany
    {
        return $this->hasMany(FormUtmResponse::class);
    }
}
