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
        Schema::create('CJ_users', function (Blueprint $table) {
            $table->id('CJ_id');
            $table->string('CJ_name');
            $table->string('CJ_email')->unique();
            $table->string('CJ_password');
            $table->string('CJ_role')->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CJ_users');
    }
};
