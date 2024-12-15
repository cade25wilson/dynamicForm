<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FormIntegrations extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'webhook'];

    public function form(): HasOne
    {
        return $this->hasOne(Form::class);
    }
}
