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
        Schema::create('stones', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome da pedra
            $table->string('alternative_names')->nullable(); // Outros nomes populares
            $table->string('image')->nullable(); // Permitir que a imagem seja opcional
            $table->text('description'); // Descrição da pedra
            $table->text('properties'); // Propriedades energéticas e esotéricas
            $table->decimal('hardness', 3, 1)->nullable(); // Escala de Mohs (Ex: 6.5 para Quartzo)
            $table->string('cleaning_method')->nullable(); // Como limpar e energizar a pedra
            $table->foreignId('type_stone_id')->constrained()->onDelete('cascade'); // Tipo da pedra
            $table->foreignId('chakra_id')->nullable()->constrained()->onDelete('set null'); // Chakra associado
            $table->foreignId('planet_id')->nullable()->constrained()->onDelete('set null'); // Planeta regente
            $table->foreignId('element_id')->nullable()->constrained()->onDelete('set null'); // Elemento associado
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stones');
    }
};
