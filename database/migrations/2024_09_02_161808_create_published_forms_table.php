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
        Schema::create('published_forms', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->foreignUuid('form_id')->constrained()->onDelete('cascade');
            $table->string('name', 100);
            $table->boolean('closed')->default(false);
            $table->date('close_by')->nullable(true)->default(null);
            $table->integer('close_by_submissions')->nullable(true)->default(null);
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
        Schema::dropIfExists('published_forms');
    }
};
