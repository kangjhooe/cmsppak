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
        Schema::table('profiles', function (Blueprint $table) {
            $table->decimal('koordinat_lat', 10, 8)->nullable()->after('website');
            $table->decimal('koordinat_lng', 11, 8)->nullable()->after('koordinat_lat');
            $table->integer('koordinat_alt')->nullable()->after('koordinat_lng');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['koordinat_lat', 'koordinat_lng', 'koordinat_alt']);
        });
    }
};
