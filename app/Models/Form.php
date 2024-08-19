<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasUuids;
    // The attributes that are mass assignable.
    protected $fillable = ['name', 'description', 'user_id'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the FormField model
    // public function fields()
    // {
    //     return $this->hasMany(FormFields::class);
    // }

    // Define the relationship with the FormResponse model
    public function responses()
    {
        return $this->hasMany(FormResponses::class);
    }

    public function design()
    {
        return $this->hasOne(FormDesign::class);
    }
}
