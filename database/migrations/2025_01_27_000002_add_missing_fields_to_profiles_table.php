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
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('jumlah_siswa')->nullable()->after('kepala_sekolah');
            $table->integer('jumlah_guru')->nullable()->after('jumlah_siswa');
            $table->integer('jumlah_kelas')->nullable()->after('jumlah_guru');
            $table->integer('tahun_berdiri')->nullable()->after('jumlah_kelas');
            $table->longText('fasilitas')->nullable()->after('tahun_berdiri');
            $table->longText('prestasi')->nullable()->after('fasilitas');
            $table->longText('struktur_organisasi')->nullable()->after('prestasi');
            $table->string('facebook')->nullable()->after('website');
            $table->string('instagram')->nullable()->after('facebook');
            $table->string('youtube')->nullable()->after('instagram');
            $table->string('twitter')->nullable()->after('youtube');
            $table->string('whatsapp_admin')->nullable()->after('twitter');
            $table->string('jam_operasional')->nullable()->after('whatsapp_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'jumlah_siswa',
                'jumlah_guru', 
                'jumlah_kelas',
                'tahun_berdiri',
                'fasilitas',
                'prestasi',
                'struktur_organisasi',
                'facebook',
                'instagram',
                'youtube',
                'twitter',
                'whatsapp_admin',
                'jam_operasional'
            ]);
        });
    }
};
