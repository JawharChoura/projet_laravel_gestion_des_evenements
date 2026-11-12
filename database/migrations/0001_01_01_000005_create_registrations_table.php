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
        Schema::create('CJ_registrations', function (Blueprint $table) {
            $table->id('CJ_id');
            $table->foreignId('CJ_user_id')->constrained('CJ_users', 'CJ_id')->onDelete('cascade');
            $table->foreignId('CJ_event_id')->constrained('CJ_events', 'CJ_id')->onDelete('cascade');
            $table->timestamps();
            
            // Ensure a user can only register once per event
            $table->unique(['CJ_user_id', 'CJ_event_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CJ_registrations');
    }
};
