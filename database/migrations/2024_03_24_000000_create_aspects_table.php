<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aspects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->integer('angle');
            $table->integer('orb');
            $table->string('nature'); // harmonioso, tenso, neutro
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('planet_aspects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planet1_id')->constrained('planets');
            $table->foreignId('planet2_id')->constrained('planets');
            $table->foreignId('aspect_id')->constrained('aspects');
            $table->decimal('angle', 8, 2);
            $table->decimal('orb', 8, 2);
            $table->boolean('is_exact');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('planet_aspects');
        Schema::dropIfExists('aspects');
    }
};
