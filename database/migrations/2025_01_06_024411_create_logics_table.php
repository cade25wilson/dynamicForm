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
        Schema::create('logics', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('form_section_id')->constrained('form_sections')->onDelete('cascade');
            $table->json('condition')->nullable(true);
            $table->json('action')->nullable(true);
            $table->json('default_action')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logics');
    }
};
