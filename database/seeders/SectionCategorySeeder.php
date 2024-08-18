<?php
namespace Database\Seeders;

use App\Models\SectionCategory;
use Illuminate\Database\Seeder;

class SectionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Contact Info',
            'Text & Video',
            'Choice',
            'Other',
            'Rating & Ranking',
            'Null', 
        ];

        foreach ($categories as $category) {
            SectionCategory::create([
                'name' => $category
            ]);
        }
    }
}
