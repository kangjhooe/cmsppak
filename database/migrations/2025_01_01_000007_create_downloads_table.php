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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('nama_file');
            $table->string('path_file');
            $table->string('tipe_file'); // pdf, doc, xls, dll
            $table->integer('ukuran_file'); // dalam bytes
            $table->integer('jumlah_download')->default(0);
            $table->string('kategori'); // silabus, kurikulum, dokumen, dll
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
