<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('magical_intentions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->json('ideal_moon_phases');
            $table->json('avoid_moon_phases');
            $table->json('planetary_days');
            $table->json('elements');
            $table->json('herbs');
            $table->json('crystals');
            $table->string('ritual_type');
            $table->json('preparation_steps');
            $table->json('during_ritual_steps');
            $table->json('post_ritual_steps');
            $table->json('magical_correspondences');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('magical_intentions');
    }
};
