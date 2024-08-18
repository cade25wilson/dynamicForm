<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'section_category_id', 'show'];

    public function sectionCategory()
    {
        return $this->belongsTo(SectionCategory::class, 'section_category_id');
    }
}
