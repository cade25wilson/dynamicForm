<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResponses extends Model
{
    use HasUuids;
    // The attributes that are mass assignable.
    protected $fillable = ['form_id', 'user_id'];

    // Define the relationship with the Form model
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the FormFieldResponse model
    public function fieldResponses()
    {
        return $this->hasMany(FormFieldResponses::class, 'response_id');
    }
}
