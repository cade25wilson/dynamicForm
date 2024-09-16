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
        Schema::create('forms', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->string('name', 100);
            // $table->text('description')->default('Mind filling out this form?');
            // $table->string('embed')->nullable(true);
            // $table->enum('text_align',['left', 'center', 'right'])->default('left');
            // $table->string('button_text')->default("Let''s Go!");
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
