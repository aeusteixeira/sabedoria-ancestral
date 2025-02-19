<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('alchemy_stone', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alchemy_id')->constrained('alchemies')->onDelete('cascade');
            $table->foreignId('stone_id')->constrained('stones')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
