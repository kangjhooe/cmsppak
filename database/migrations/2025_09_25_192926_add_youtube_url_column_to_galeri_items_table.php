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
        Schema::table('galeri_items', function (Blueprint $table) {
            // Cek apakah kolom youtube_url belum ada
            if (!Schema::hasColumn('galeri_items', 'youtube_url')) {
                $table->string('youtube_url')->nullable()->after('file_path');
            }
            
            // Update enum jenis untuk mendukung youtube (only if column exists)
            if (Schema::hasColumn('galeri_items', 'jenis')) {
                try {
                    $table->enum('jenis', ['foto', 'video', 'youtube'])->change();
                } catch (\Exception $e) {
                    // Ignore if enum change fails
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeri_items', function (Blueprint $table) {
            // Hapus kolom youtube_url jika ada
            if (Schema::hasColumn('galeri_items', 'youtube_url')) {
                $table->dropColumn('youtube_url');
            }
            
            // Kembalikan enum jenis ke yang lama
            $table->enum('jenis', ['foto', 'video'])->change();
        });
    }
};
