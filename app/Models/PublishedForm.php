<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PublishedForm extends Model
{
    use HasUuids;
    // The attributes that are mass assignable.
    protected $fillable = ['form_id', 'name', 'user_id'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function form()
    {
        return $this->hasOne(Form::class);
    }
    // Define the relationship with the FormField model
    // public function fields()
    // {
    //     return $this->hasMany(FormFields::class);
    // }

    // Define the relationship with the FormResponse model

    public function design()
    {
        return $this->hasOne(PublishedFormDesign::class);
    }
}
