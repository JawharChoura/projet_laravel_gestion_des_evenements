<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('CJ_events', function (Blueprint $table) {
            $table->enum('CJ_status', ['active', 'archived'])->default('active')->after('CJ_image');
        });
    }

    public function down(): void
    {
        Schema::table('CJ_events', function (Blueprint $table) {
            $table->dropColumn('CJ_status');
        });
    }
};
