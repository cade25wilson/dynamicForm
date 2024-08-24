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
        Schema::create('form_sections', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->foreignUuid('form_id')->constrained('forms')                                                                                                                                                                                                                                                                                                    ;
            $table->foreignId('section_type_id')->constrained('section_types');
            $table->integer('order')->default(1)->index();
            $table->string('name')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('button_text')->default('continue');
            $table->json('options')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_sections');
    }
};
