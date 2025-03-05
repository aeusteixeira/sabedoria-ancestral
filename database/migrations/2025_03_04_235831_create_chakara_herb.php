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
        Schema::create('chakra_herb', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chakra_id')->constrained('chakras')->onDelete('cascade');
            $table->foreignId('herb_id')->constrained('herbs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chakra_herb');
    }
};
