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
        if (! Schema::hasColumn('books', 'user_id') || ! Schema::hasColumn('books', 'type')) {
            Schema::table('books', function (Blueprint $table) {
                if (! Schema::hasColumn('books', 'user_id')) {
                    $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
                }

                if (! Schema::hasColumn('books', 'type')) {
                    $table->enum('type', ['book', 'story'])->default('book');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            //
        });
    }
};
