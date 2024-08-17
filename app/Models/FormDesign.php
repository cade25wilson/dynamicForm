<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDesign extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['form_id', 'background', 'questions', 'answers', 'buttons', 'button_text', 'star_rating', 'font', 'background_image', 'logo'];

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
}
