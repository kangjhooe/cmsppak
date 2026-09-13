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
            // Add view_count column if it doesn't exist
            if (!Schema::hasColumn('berita', 'view_count')) {
                $table->unsignedBigInteger('view_count')->default(0)->after('published_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            if (Schema::hasColumn('berita', 'view_count')) {
                $table->dropColumn('view_count');
            }
        });
    }
};