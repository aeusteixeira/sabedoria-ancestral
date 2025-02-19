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
        Schema::create('alchemies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('alchemy_type_id')->constrained('alchemy_types')->onDelete('set null');
            $table->text('description')->nullable();
            $table->text('preparation_method')->nullable();
            $table->text('precautions')->nullable();
            $table->foreignId('moon_id')->nullable()->constrained('moons');
            $table->foreignId('day_of_week_id')->nullable()->constrained('day_of_weeks');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alchemies');
    }
};
