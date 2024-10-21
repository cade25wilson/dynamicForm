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
        Schema::create('form_utm_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_utm_parameters')->constrained()->onDelete('cascade');
            $table->string('utm_value');
            $table->foreignUuid('form_responses_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_utm_responses');
    }
};
