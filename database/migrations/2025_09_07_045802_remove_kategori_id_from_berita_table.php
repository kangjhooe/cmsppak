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
        Schema::table('berita', function (Blueprint $table) {
            // Remove foreign key constraint first
            $table->dropForeign(['kategori_id']);
            // Then drop the column
            $table->dropColumn('kategori_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Add back the column
            $table->foreignId('kategori_id')->nullable()->constrained('kategori')->onDelete('set null');
        });
    }
};
