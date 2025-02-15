<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PublishedForm extends Model
{
    use HasUuids;
    // The attributes that are mass assignable.
    protected $fillable = ['id', 'form_id', 'name', 'user_id', 'closed', 'close_by', 'close_by_submissions'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function form()
    {
        return $this->hasOne(Form::class);
    }

    public function sections()
    {
        return $this->hasMany(PublishedFormSection::class);
    }

    // Define the relationship with the FormResponse model
    public function utmParameters()
    {
        return $this->hasMany(FormUtmParameter::class);
    }
    
    public function design()
    {
        return $this->hasOne(PublishedFormDesign::class);
    }
}
