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
        Schema::create('form_designs', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->foreignUuid('form_id')->constrained()->onDelete('cascade');
            $table->string('background', 20);
            $table->string('questions', 20);
            $table->string('answers', 20);
            $table->string('buttons', 20);
            $table->string('button_text', 20);
            $table->string('star_rating', 20);
            $table->string('font', 20);
            $table->string('background_image', 200);
            $table->string('logo', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_designs');
    }
};
