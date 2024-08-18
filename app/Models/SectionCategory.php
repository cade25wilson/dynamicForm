<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionCategory extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function sectionTypes()
    {
        return $this->hasMany(SectionType::class, 'section_category_id');
    }
}
