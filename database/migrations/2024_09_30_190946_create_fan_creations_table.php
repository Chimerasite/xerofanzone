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
        Schema::create('fan_creations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('tags')->nullable();
            $table->string('thumbnail')->nullable();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->set('art_permission', ['yes', 'ask', 'no'])->default('yes');
            $table->set('writing_permission', ['yes', 'ask', 'no'])->default('yes');
            $table->boolean('public')->default(false);
            $table->string('contact')->nullable();
            $table->string('external_link')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fan_creations');
    }
};
