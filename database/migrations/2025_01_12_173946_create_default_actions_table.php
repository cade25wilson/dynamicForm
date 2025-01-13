<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('default_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('form_section_id')->constrained('form_sections')->onDelete('cascade');
            $table->string("type")->nullable(); // Make "type" nullable
            $table->foreignUuid('target')->nullable()->constrained('form_sections')->onDelete('cascade'); // Make "target" nullable
            $table->timestamps();
        });

        Schema::create('published_default_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('published_form_section_id')->constrained('published_form_sections')->onDelete('cascade');
            $table->string("type")->nullable();
            $table->foreignUuid('target')->nullable()->constrained('published_form_sections')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_actions');
        Schema::dropIfExists('published_default_actions');
    }
};
