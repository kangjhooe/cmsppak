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
        Schema::table('comments', function (Blueprint $table) {
            // Tambahkan kolom user_id yang nullable (jika belum ada)
            if (!Schema::hasColumn('comments', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            }
            
            // Tambahkan kolom parent_id yang nullable untuk sistem reply (jika belum ada)
            if (!Schema::hasColumn('comments', 'parent_id')) {
                $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
};