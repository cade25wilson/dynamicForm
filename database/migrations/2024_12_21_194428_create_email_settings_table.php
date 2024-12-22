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
        Schema::create('email_settings', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->foreignUuid('form_id')->constrained('forms')->onDelete('cascade');
            $table->boolean('send_email')->default(true);
            $table->string('send_to')->default(null);
            $table->string('subject');
            $table->boolean('email_form_filler')->default(false);
            $table->string('form_filler_email')->nullable()->default(null);
            $table->string('reply_to')->nullable()->default(null);
            $table->string('form_filler_email_subject')->default(null)->nullable();
            $table->string('from_name')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_settings');
    }
};
