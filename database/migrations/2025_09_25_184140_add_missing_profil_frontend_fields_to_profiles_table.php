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
            // Tambahkan kolom-kolom profil frontend yang hilang
            if (!Schema::hasColumn('profiles', 'profil_hero_title')) {
                $table->string('profil_hero_title')->nullable()->after('logo');
            }
            if (!Schema::hasColumn('profiles', 'profil_hero_subtitle')) {
                $table->string('profil_hero_subtitle')->nullable()->after('profil_hero_title');
            }
            if (!Schema::hasColumn('profiles', 'profil_hero_description')) {
                $table->text('profil_hero_description')->nullable()->after('profil_hero_subtitle');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_statistics')) {
                $table->boolean('profil_show_statistics')->default(true)->after('profil_hero_description');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_contact')) {
                $table->boolean('profil_show_contact')->default(true)->after('profil_show_statistics');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_social_media')) {
                $table->boolean('profil_show_social_media')->default(true)->after('profil_show_contact');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_principal')) {
                $table->boolean('profil_show_principal')->default(true)->after('profil_show_social_media');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_vision_mission')) {
                $table->boolean('profil_show_vision_mission')->default(true)->after('profil_show_principal');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_history')) {
                $table->boolean('profil_show_history')->default(true)->after('profil_show_vision_mission');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_facilities')) {
                $table->boolean('profil_show_facilities')->default(true)->after('profil_show_history');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_achievements')) {
                $table->boolean('profil_show_achievements')->default(true)->after('profil_show_facilities');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_organization')) {
                $table->boolean('profil_show_organization')->default(true)->after('profil_show_achievements');
            }
            if (!Schema::hasColumn('profiles', 'profil_show_emergency_contact')) {
                $table->boolean('profil_show_emergency_contact')->default(true)->after('profil_show_organization');
            }
            if (!Schema::hasColumn('profiles', 'profil_custom_sections')) {
                $table->json('profil_custom_sections')->nullable()->after('profil_show_emergency_contact');
            }
            if (!Schema::hasColumn('profiles', 'foto_kepala_madrasah')) {
                $table->string('foto_kepala_madrasah')->nullable()->after('logo');
            }
            if (!Schema::hasColumn('profiles', 'tiktok')) {
                $table->string('tiktok')->nullable()->after('twitter');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Hapus kolom-kolom yang ditambahkan
            $columnsToDrop = [
                'profil_hero_title',
                'profil_hero_subtitle', 
                'profil_hero_description',
                'profil_show_statistics',
                'profil_show_contact',
                'profil_show_social_media',
                'profil_show_principal',
                'profil_show_vision_mission',
                'profil_show_history',
                'profil_show_facilities',
                'profil_show_achievements',
                'profil_show_organization',
                'profil_show_emergency_contact',
                'profil_custom_sections',
                'foto_kepala_madrasah',
                'tiktok'
            ];
            
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('profiles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
