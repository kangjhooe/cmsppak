<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (! Schema::hasColumn('profiles', 'jenis_lembaga')) {
                $table->string('jenis_lembaga', 32)
                    ->default('pesantren')
                    ->after('nama_sekolah');
            }
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (Schema::hasColumn('profiles', 'jenis_lembaga')) {
                $table->dropColumn('jenis_lembaga');
            }
        });
    }
};
