<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Profile;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Check if profiles table exists before accessing it
        if (!Schema::hasTable('profiles')) {
            return;
        }

        try {
            $profile = Profile::first();
        } catch (\Exception $e) {
            $profile = null;
        }

        $schoolName = data_get($profile, 'nama_sekolah', config('app.name'));
        $schoolTagline = data_get($profile, 'profil_hero_subtitle', $schoolName);
        $schoolDescription = data_get($profile, 'profil_hero_description', data_get($profile, 'deskripsi', $schoolTagline));

        $sharedData = [
            'profile' => $profile,
            'schoolName' => $schoolName,
            'schoolTagline' => $schoolTagline,
            'schoolDescription' => $schoolDescription,
        ];

        // Share profile data to all frontend views
        View::composer('layouts.frontend', function ($view) use ($sharedData) {
            $view->with($sharedData);
        });
        
        // Share profile data to all frontend views yang extend frontend layout
        View::composer(['frontend.*', 'errors.404'], function ($view) use ($sharedData) {
            $view->with($sharedData);
        });
        
        // Share profile data to guest layout
        View::composer('components.guest-layout', function ($view) use ($sharedData) {
            $view->with($sharedData);
        });
        
        // Share profile data globally ke seluruh view
        View::share($sharedData);
    }
}
