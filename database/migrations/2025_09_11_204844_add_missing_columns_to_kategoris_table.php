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
        Schema::table('kategori', function (Blueprint $table) {
            if (!Schema::hasColumn('kategori', 'slug')) {
                $table->string('slug')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('kategori', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('kategori', 'warna')) {
                $table->string('warna', 7)->default('#007bff')->after('deskripsi');
            }
            if (!Schema::hasColumn('kategori', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('warna');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropColumn(['slug', 'deskripsi', 'warna', 'is_active']);
        });
    }
};
