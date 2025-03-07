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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('type', ['presencial', 'online'])->default('presencial');
            $table->enum('contact_type', ['whatsapp', 'link', 'telefone', 'email', 'instagram', 'telegram', 'facebook'])
            ->default('whatsapp');
            $table->string('contact_info');
            $table->boolean('active')->default(true);
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete(action: 'cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
