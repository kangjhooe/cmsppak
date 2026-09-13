<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Profile;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Handle dynamic slug routes
     */
    public function show($slug)
    {
        // Cek apakah slug adalah route yang sudah ada
        $existingRoutes = ['admin', 'api', 'dashboard', 'profile', 'user', 'frontend'];
        if (in_array($slug, $existingRoutes)) {
            abort(404);
        }
        
        // Ambil data profile untuk layout
        $profile = Profile::first();
        
        // Coba cari berita dengan slug ini
        $berita = Berita::where('slug', $slug)
            ->where('status', 'published')
            ->first();
        
        if ($berita) {
            // Jika ditemukan berita, redirect ke route berita yang benar
            return redirect()->route('berita.show', $slug);
        }
        
        // Jika tidak ditemukan, tampilkan halaman 404 dengan layout yang konsisten
        return view('errors.404', compact('profile'));
    }
}
