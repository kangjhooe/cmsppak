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
            // Field untuk mengelola konten halaman profil frontend
            $table->string('profil_hero_title')->nullable()->after('logo');
            $table->string('profil_hero_subtitle')->nullable()->after('profil_hero_title');
            $table->text('profil_hero_description')->nullable()->after('profil_hero_subtitle');
            
            // Field boolean untuk mengontrol tampilan section
            $table->boolean('profil_show_statistics')->default(true)->after('profil_hero_description');
            $table->boolean('profil_show_contact')->default(true)->after('profil_show_statistics');
            $table->boolean('profil_show_social_media')->default(true)->after('profil_show_contact');
            $table->boolean('profil_show_principal')->default(true)->after('profil_show_social_media');
            $table->boolean('profil_show_vision_mission')->default(true)->after('profil_show_principal');
            $table->boolean('profil_show_history')->default(true)->after('profil_show_vision_mission');
            $table->boolean('profil_show_facilities')->default(true)->after('profil_show_history');
            $table->boolean('profil_show_achievements')->default(true)->after('profil_show_facilities');
            $table->boolean('profil_show_organization')->default(true)->after('profil_show_achievements');
            $table->boolean('profil_show_emergency_contact')->default(true)->after('profil_show_organization');
            
            // Field JSON untuk custom sections
            $table->json('profil_custom_sections')->nullable()->after('profil_show_emergency_contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
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
                'profil_custom_sections'
            ]);
        });
    }
};
