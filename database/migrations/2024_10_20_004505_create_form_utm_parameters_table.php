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
        Schema::create('form_utm_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('form_id')->constrained()->onDelete('cascade');
            $table->string('utm_key')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_utm_parameters');
    }
};