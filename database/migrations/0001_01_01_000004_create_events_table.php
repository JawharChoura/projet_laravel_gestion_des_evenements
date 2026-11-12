<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('CJ_events', function (Blueprint $table) {
            $table->id('CJ_id');
            $table->string('CJ_title');
            $table->text('CJ_description');
            $table->dateTime('CJ_start_date');
            $table->dateTime('CJ_end_date');
            $table->string('CJ_place');
            $table->decimal('CJ_price', 8, 2)->default(0);
            $table->boolean('CJ_is_free')->default(true);
            $table->integer('CJ_capacity');
            $table->string('CJ_image')->nullable();
            $table->foreignId('CJ_category_id')->constrained('CJ_categories', 'CJ_id')->onDelete('cascade');
            $table->foreignId('CJ_created_by')->constrained('CJ_users', 'CJ_id')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('CJ_events');
    }
};
