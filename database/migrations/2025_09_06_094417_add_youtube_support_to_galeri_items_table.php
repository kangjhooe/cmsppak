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
            $table->string('youtube_url')->nullable()->after('file_path');
            $table->enum('jenis', ['foto', 'video', 'youtube'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeri_items', function (Blueprint $table) {
            $table->dropColumn('youtube_url');
            $table->enum('jenis', ['foto', 'video'])->change();
        });
    }
};
