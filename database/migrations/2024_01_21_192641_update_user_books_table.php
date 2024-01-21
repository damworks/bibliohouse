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
        Schema::table('user_books', function (Blueprint $table) {
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->boolean('is_reading')->default(false);

            $table->index(['user_id', 'book_id']);
            $table->index('is_read');
            $table->index(['started_at', 'finished_at']);
            $table->index('is_reading');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_books', function (Blueprint $table) {
            $table->dropColumn('started_at');
            $table->dropColumn('finished_at');
            $table->dropColumn('is_reading');

            $table->dropIndex(['user_id', 'book_id']);
            $table->dropIndex('is_read');
            $table->dropIndex(['started_at', 'finished_at']);
            $table->dropIndex('is_reading');
        });
    }
};
