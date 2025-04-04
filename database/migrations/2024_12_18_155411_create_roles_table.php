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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->integer('is_admin');
            $table->string('name');
            $table->boolean('edit_settings')->default(false);
            $table->boolean('edit_posts')->default(false);
            $table->boolean('edit_locations')->default(false);
            $table->boolean('edit_foraging_locations')->default(false);
            $table->boolean('edit_items')->default(false);
            $table->boolean('edit_containers')->default(false);
            $table->boolean('mass_edit_foraging')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
