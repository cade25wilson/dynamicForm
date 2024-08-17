<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormFieldResponses extends Model
{
    use HasUuids;
    // The attributes that are mass assignable.
    protected $fillable = ['response_id', 'form_field_id', 'value'];

    // Define the relationship with the FormResponse model
    public function formResponse()
    {
        return $this->belongsTo(FormResponses::class, 'response_id');
    }

    // Define the relationship with the FormField model
    public function formField()
    {
        return $this->belongsTo(FormFields::class, 'form_field_id');
    }
}
