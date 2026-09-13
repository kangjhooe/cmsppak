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
        if (!Schema::hasTable('profiles')) {
            return;
        }

        if (!Schema::hasColumn('profiles', 'tiktok')) {
            Schema::table('profiles', function (Blueprint $table) {
                if (Schema::hasColumn('profiles', 'twitter')) {
                    $table->string('tiktok')->nullable()->after('twitter');
                } else {
                    $table->string('tiktok')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('tiktok');
        });
    }
};
