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
        Schema::create('published_form_sections', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->foreignUuid('published_form_id')->constrained('published_forms')->onDelete('cascade');
            $table->foreignId('section_type_id')->constrained('section_types');
            $table->integer('order')->default(1)->index();
            $table->string('name')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('button_text')->default('Continue');
            $table->string('background_image')->nullable(true);
            $table->string('text_align')->default('left');
            $table->json('options')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('published_form_sections');
    }
};
