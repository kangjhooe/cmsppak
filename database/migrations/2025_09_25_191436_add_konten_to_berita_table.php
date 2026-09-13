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
            // Tambahkan kolom konten jika belum ada
            if (!Schema::hasColumn('berita', 'konten')) {
                $table->longText('konten')->after('slug');
            }
            
            // Tambahkan kolom ringkasan jika belum ada
            if (!Schema::hasColumn('berita', 'ringkasan')) {
                $table->text('ringkasan')->nullable()->after('slug');
            }
            
            // Tambahkan kolom meta_title jika belum ada
            if (!Schema::hasColumn('berita', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('gambar_utama');
            }
            
            // Tambahkan kolom meta_description jika belum ada
            if (!Schema::hasColumn('berita', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan
            if (Schema::hasColumn('berita', 'konten')) {
                $table->dropColumn('konten');
            }
            
            if (Schema::hasColumn('berita', 'ringkasan')) {
                $table->dropColumn('ringkasan');
            }
            
            if (Schema::hasColumn('berita', 'meta_title')) {
                $table->dropColumn('meta_title');
            }
            
            if (Schema::hasColumn('berita', 'meta_description')) {
                $table->dropColumn('meta_description');
            }
        });
    }
};