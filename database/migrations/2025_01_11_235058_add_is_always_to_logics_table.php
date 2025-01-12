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
        Schema::table('logics', function (Blueprint $table) {
            $table->boolean('is_always')->default(false)->after('form_section_id');
        });
        Schema::table('published_logics', function (Blueprint $table) {
            $table->boolean('is_always')->default(false)->after('form_section_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logics', function (Blueprint $table) {
            $table->dropColumn('is_always');
        });
        Schema::table('published_logics', function (Blueprint $table) {
            $table->dropColumn('is_always');
        });
    }
};
