<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rituals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('intention');
            $table->datetime('date');
            $table->foreignId('moon_id')->constrained();
            $table->text('notes')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        Schema::create('ritual_element', function (Blueprint $table) {
            $table->foreignId('ritual_id')->constrained()->onDelete('cascade');
            $table->foreignId('element_id')->constrained()->onDelete('cascade');
            $table->primary(['ritual_id', 'element_id']);
        });

        Schema::create('ritual_herb', function (Blueprint $table) {
            $table->foreignId('ritual_id')->constrained()->onDelete('cascade');
            $table->foreignId('herb_id')->constrained()->onDelete('cascade');
            $table->primary(['ritual_id', 'herb_id']);
        });

        Schema::create('ritual_stone', function (Blueprint $table) {
            $table->foreignId('ritual_id')->constrained()->onDelete('cascade');
            $table->foreignId('stone_id')->constrained()->onDelete('cascade');
            $table->primary(['ritual_id', 'stone_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ritual_stone');
        Schema::dropIfExists('ritual_herb');
        Schema::dropIfExists('ritual_element');
        Schema::dropIfExists('rituals');
    }
};