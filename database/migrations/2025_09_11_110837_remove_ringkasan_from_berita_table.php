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
            // Hapus kolom ringkasan dari tabel berita
            if (Schema::hasColumn('berita', 'ringkasan')) {
                $table->dropColumn('ringkasan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Tambahkan kembali kolom ringkasan jika diperlukan
            $table->text('ringkasan')->nullable()->after('slug');
        });
    }
};