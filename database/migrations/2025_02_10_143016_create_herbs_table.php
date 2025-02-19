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
        Schema::create('herbs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('history_origin')->nullable();
            $table->text('magical_uses')->nullable();
            $table->text('biological_uses')->nullable();
            $table->text('precautions')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('planet_regent_id')->nullable()->constrained('planets');
            $table->foreignId('element_regent_id')->nullable()->constrained('elements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herbs');
    }
};
