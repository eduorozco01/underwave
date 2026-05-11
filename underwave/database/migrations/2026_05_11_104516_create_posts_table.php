<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('category'); // Música, Teatro, Mercadillo, Arte
            $table->string('location')->nullable();
            $table->string('external_url')->nullable(); // Para Spotify o YouTube
            $table->enum('price_range', ['Gratis', '<10€', '>10€', 'N/A'])->default('N/A');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // El autor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
