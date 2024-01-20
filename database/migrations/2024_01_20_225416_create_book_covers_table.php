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
        Schema::create('book_covers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedInteger('order')->default(0);
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');

        });

        // Aggiungi un indice per le colonne 'book_id' e 'order'
        Schema::table('book_covers', function (Blueprint $table) {
            $table->index(['book_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_covers');
    }
};
