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
        // Hapus kolom kategori_id dari tabel berita karena menggunakan relasi many-to-many
        if (Schema::hasColumn('berita', 'kategori_id')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->dropColumn('kategori_id');
            });
        }

        // Hapus kolom isi dari tabel berita jika masih ada (sudah diganti dengan konten)
        if (Schema::hasColumn('berita', 'isi')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->dropColumn('isi');
            });
        }

        // Hapus kolom yang tidak digunakan dari tabel users (Jetstream/Fortify)
        if (Schema::hasColumn('users', 'current_team_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('current_team_id');
            });
        }

        // Hapus kolom yang tidak digunakan dari tabel profiles
        if (Schema::hasColumn('profiles', 'theme')) {
            Schema::table('profiles', function (Blueprint $table) {
                $table->dropColumn('theme');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tambahkan kembali kolom yang dihapus jika diperlukan
        Schema::table('berita', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->nullable()->after('user_id');
            $table->text('isi')->nullable()->after('slug');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('current_team_id')->nullable()->after('remember_token');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->string('theme')->default('default')->after('logo');
        });
    }
};
