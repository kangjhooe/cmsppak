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
            // Hapus kolom kategori lama (string)
            $table->dropColumn('kategori');
            
            // Tambah foreign key ke tabel kategori
            $table->foreignId('kategori_id')->nullable()->constrained('kategori')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
            
            // Kembalikan kolom kategori lama
            $table->string('kategori')->nullable();
        });
    }
};
