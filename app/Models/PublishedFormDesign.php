<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedFormDesign extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['published_form_id', 'background', 'questions', 'answers', 'buttons', 'button_text', 'star_rating', 'font', 'background_image', 'logo'];

    public function form()
    {
        return $this->belongsTo(PublishedForm::class, 'published_form_id');
    }
}
