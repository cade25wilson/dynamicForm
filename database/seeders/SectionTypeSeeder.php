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
            'id' => 1,
            'name' => 'Start',
            'description' => 'Start of form',
            'show' => false,
            'section_category_id' => 5,
            'default_name' => 'Hey there 😀'
        ]);
        DB::table('section_types')->insert([
            'id' => 2,
            'name' => 'End',
            'description' => 'End of form',
            'show' => false,
            'section_category_id' => 5,
            'default_name' => 'Thank you! 🙌'
        ]);
        DB::table('section_types')->insert([
            'id' => 3,
            'name' => 'Contact Info',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 1,
            'default_name' => 'Please fill the following'
        ]);
        DB::table('section_types')->insert([
            'id' => 4,
            'name' => 'Short Text',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 2,
            'default_name' => ''
        ]);
        DB::table('section_types')->insert([
            'id' => 5,
            'name' => 'Long Text',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 2,
            'default_name' => ''
        ]);
        DB::table('section_types')->insert([
            'id' => 6,
            'name' => 'Phone Number',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 1,
            'default_name' => 'Please enter your phone number'
        ]);
        // DB::table('section_types')->insert([
        //     'id' => 7,
        //     'name' => 'Statement',
        //     'description' => 'Start of form',
        //     'show' => true,
        //     'section_category_id' => 2,
        //     'default_name' => ''
        // ]);
        DB::table('section_types')->insert([
            'id' => 8,
            'name' => 'Single Select Option',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 3,
            'default_name' => 'Which do you prefer? 👇'
        ]);
        DB::table('section_types')->insert([
            'id' => 9,
            'name' => 'Multi Select Option',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 3,
            'default_name' => 'Please choose at least one option 👇'

        ]);
        DB::table('section_types')->insert([
            'id' => 10,
            'name' => 'Dropdown List',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 3,
            'default_name' => 'Please choose 👇'

        ]);
        DB::table('section_types')->insert([
            'id' => 11,
            'name' => 'Date',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 4,
            'default_name' => 'Please select a date'

        ]);
        DB::table('section_types')->insert([
            'id' => 12,
            'name' => 'Scheduler',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 4,
            'default_name' => 'When can we meet?'

        ]);
        DB::table('section_types')->insert([
            'id' => 13,
            'name' => 'Star Rating',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 3,
            'default_name' => 'How would you rate your experience? ✨'

        ]);
        DB::table('section_types')->insert([
            'id' => 14,
            'name' => 'Opinion Scale',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 3,
            'default_name' => 'How likely are you to recommend us?'

        ]);
        DB::table('section_types')->insert([
            'id' => 15,
            'name' => 'Signature',
            'description' => 'Start of form',
            'show' => true,
            'section_category_id' => 2,
            'default_name' => 'Please sign here'

        ]);
        DB::table('section_types')->insert([
            'id' => 16,
            'name' => 'File Upload',
            'description' => 'End of form',
            'show' => true,
            'section_category_id' => 4,
            'default_name' => 'Please upload a file'
        ]);
        DB::table('section_types')->insert([
            'id' => 17,
            'name' => 'Payment',
            'description' => 'Accept a Payment',
            'show' => true,
            'section_category_id' => 5,
            'default_name' => 'Enter Card Details.'
        ]);
    }
}