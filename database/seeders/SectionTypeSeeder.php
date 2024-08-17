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
            'description' => 'Start of form'
        ]);
        DB::table('section_types')->insert([
            'name' => 'End',
            'description' => 'End of form'
        ]);
    }
}
