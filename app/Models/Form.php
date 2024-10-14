<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Form extends Model
{
    use HasUuids;
    // The attributes that are mass assignable.
    protected $fillable = ['name', 'user_id'];

    // Define the relationship with the User model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the FormResponse model
    public function responses(): HasMany
    {
        return $this->hasMany(FormResponses::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(FormSection::class);
    }

    public function design(): HasOne
    {
        return $this->hasOne(FormDesign::class);
    }

    public function publishedForm(): HasOne
    {
        return $this->hasOne(PublishedForm::class);
    }

    public function formIntegration(): HasOne
    {
        return $this->hasOne(FormIntegrations::class);
    }
}
