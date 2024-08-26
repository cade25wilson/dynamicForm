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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            // $table->foreignUuid('form_id')->constrained()->onDelete('cascade');
            $table->string('label', 255)->nullable(true);
            $table->string('placeholder')->nullable(true);
            $table->string('type', 50);
            $table->boolean('required')->default(false);
            $table->integer('order')->default(1)->index();
            $table->boolean('show')->default(true)->index();
            $table->jsonb('options')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
