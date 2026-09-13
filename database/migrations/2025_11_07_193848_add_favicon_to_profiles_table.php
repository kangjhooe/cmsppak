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

        if (!Schema::hasColumn('profiles', 'favicon')) {
            Schema::table('profiles', function (Blueprint $table) {
                if (Schema::hasColumn('profiles', 'logo')) {
                    $table->string('favicon')->nullable()->after('logo');
                } else {
                    $table->string('favicon')->nullable();
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
            if (Schema::hasColumn('profiles', 'favicon')) {
                $table->dropColumn('favicon');
            }
        });
    }
};
