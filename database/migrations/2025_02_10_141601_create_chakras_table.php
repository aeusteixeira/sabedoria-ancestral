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
        Schema::create('chakras', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('slug');
            $table->text('description');
            $table->string('color');
            $table->string('color_hex');
            $table->string('color_text');
            $table->string('location');
            $table->string('mantra');
            $table->foreignId('element_id')->nullable()->constrained()->onDelete('set null'); // Elemento associado
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chakras');
    }
};
