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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Book', 'Comic', 'Magazine'])->default('Book');
            $table->string('title');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->integer('publication_year')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('shelf_code')->nullable();
            $table->boolean('is_borrowed')->default(false);
            $table->enum('format', ['Print', 'Digital', 'Other']);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('set null');

            $table->index('title');
            $table->index('author_id');
            $table->index('genre_id');
        });

        // Aggiungi un indice composto per i campi 'title' e 'author_id'
        Schema::table('books', function (Blueprint $table) {
            $table->index(['title', 'author_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
