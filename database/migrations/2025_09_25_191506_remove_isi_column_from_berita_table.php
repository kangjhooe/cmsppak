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
            // Hapus kolom isi jika masih ada (sudah diganti dengan konten)
            if (Schema::hasColumn('berita', 'isi')) {
                $table->dropColumn('isi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Tambahkan kembali kolom isi jika diperlukan
            $table->longText('isi')->after('slug');
        });
    }
};