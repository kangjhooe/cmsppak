<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with(['user', 'kategori'])
            ->where('status', 'published')
            ->where('published_at', '<=', now());
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', '%' . $searchTerm . '%')
                  ->orWhere('konten', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Category filter
        if ($request->has('kategori') && $request->kategori) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('nama', $request->kategori);
            });
        }
        
        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'popular':
                $query->orderBy('view_count', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }
        
        $berita = $query->paginate(12);
        
        // Get categories for filter dropdown with caching
        $kategoris = Cache::remember('berita_kategoris', 3600, function() {
            return Kategori::active()
                ->whereHas('berita', function($q) {
                    $q->where('status', 'published')
                      ->where('published_at', '<=', now());
                })
                ->orderBy('nama')
                ->get();
        });
        
        // Cache profile data
        $profile = Cache::remember('profile_data', 1800, function() {
            return Profile::first();
        });
        
        return view('frontend.berita.index', compact('berita', 'kategoris', 'profile'));
    }

    public function show($slug)
    {
        $berita = Berita::with(['user', 'kategori', 'comments'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->firstOrFail();
            
        // Increment view count
        $berita->increment('view_count');
            
        // Get related news with caching
        $beritaTerbaru = Cache::remember("berita_terbaru_{$berita->id}", 1800, function() use ($berita) {
            return Berita::with(['user', 'kategori'])
                ->where('status', 'published')
                ->where('published_at', '<=', now())
                ->where('id', '!=', $berita->id)
                ->orderBy('published_at', 'desc')
                ->limit(5)
                ->get();
        });
            
        // Get popular categories for sidebar
        $kategorisPopuler = Cache::remember('kategoris_populer', 3600, function() {
            return Kategori::active()
                ->withCount(['berita' => function($q) {
                    $q->where('status', 'published')
                      ->where('published_at', '<=', now());
                }])
                ->having('berita_count', '>', 0)
                ->orderBy('berita_count', 'desc')
                ->limit(6)
                ->get();
        });
        
        // Cache profile data
        $profile = Cache::remember('profile_data', 1800, function() {
            return Profile::first();
        });
        
        return view('frontend.berita.show', compact('berita', 'beritaTerbaru', 'kategorisPopuler', 'profile'));
    }

    public function apiIndex(Request $request)
    {
        $query = Berita::with(['user', 'kategori'])->where('status', 'published');
        
        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }
        
        $berita = $query->orderBy('published_at', 'desc')->paginate(10);
        
        return response()->json($berita);
    }
}
