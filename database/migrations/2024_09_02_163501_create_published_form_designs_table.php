<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('published_form_designs', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->foreignUuid('published_form_id')->constrained('published_forms')->onDelete('cascade');
            $table->string('background', 20)->default('#ffffff');
            $table->string('questions', 20)->default('#000000');
            $table->string('answers', 20)->default('#000000');
            $table->string('buttons', 20)->default('#000000');
            $table->string('button_text', 20)->default('#ffffff');
            $table->string('star_rating', 20)->default('#000000');
            $table->string('font', 20)->default('Inter');
            $table->string('background_image', 200)->nullable(true);
            $table->string('logo', 200)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('published_form_designs');
    }
};
