<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('guru_staf');
    }

    public function down(): void
    {
        Schema::create('guru_staf', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->nullable();
            $table->string('nama_lengkap');
            $table->string('jabatan')->nullable();
            $table->string('mata_pelajaran')->nullable();
            $table->text('biodata')->nullable();
            $table->string('foto')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }
};
