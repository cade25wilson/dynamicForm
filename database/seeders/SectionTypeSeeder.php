<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('section_types')->insert([
            'name' => 'Start',
            'description' => 'Start of form',
            'show' => false,
            'section_category_id' => 6
        ]);
        DB::table('section_types')->insert([
            'name' => 'End',
            'description' => 'End of form',
            'show' => false,
            'section_category_id' => 6
        ]);
        DB::table('section_types')->insert([
            'name' => 'Contact Info',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 1
            
        ]);
        DB::table('section_types')->insert([
            'name' => 'Short Text',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 2
        ]);
        DB::table('section_types')->insert([
            'name' => 'Long Text',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 2
        ]);
        DB::table('section_types')->insert([
            'name' => 'Phone Number',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 1
        ]);
        DB::table('section_types')->insert([
            'name' => 'Statement',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 2
        ]);
        DB::table('section_types')->insert([
            'name' => 'Single Select Option',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 3
        ]);
        DB::table('section_types')->insert([
            'name' => 'Multi Select Option',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 3
        ]);
        DB::table('section_types')->insert([
            'name' => 'Dropdown List',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 3
        ]);
        DB::table('section_types')->insert([
            'name' => 'Date',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 4
        ]);
        DB::table('section_types')->insert([
            'name' => 'Scheduler',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 4
        ]);
        DB::table('section_types')->insert([
            'name' => 'Star Rating',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 3
        ]);
        DB::table('section_types')->insert([
            'name' => 'Opinion Scale',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 3
        ]);
        DB::table('section_types')->insert([
            'name' => 'Signature',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 2
        ]);
        DB::table('section_types')->insert([
            'name' => 'File Upload',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 4
        ]);
    }
}