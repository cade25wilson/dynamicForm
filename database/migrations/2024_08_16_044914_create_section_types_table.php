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
        Schema::create('section_types', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(true);
            $table->string('name', 60)->nullable(true);
            $table->text('description')->nullable(true);
            $table->boolean('show')->defualt(true)->index();
            $table->json('options')->nullable(true);
            $table->string('default_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_types');
    }
};
