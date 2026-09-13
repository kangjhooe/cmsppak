<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Profile;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Galeri::with(['activeItems'])->where('status', 'active');
            
            // Search functionality
            if ($request->has('search') && $request->search) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('judul', 'like', '%' . $searchTerm . '%')
                      ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
                });
            }
            
            // Sort options
            $sortBy = $request->get('sort', 'latest');
            switch ($sortBy) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'latest':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
            
            $galeri = $query->paginate(12);
            $profile = Profile::first();
            
            \Log::info('Frontend Galeri Index', [
                'galeri_count' => $galeri->count(),
                'total_galeri' => $galeri->total(),
                'search_term' => $request->get('search'),
                'sort_by' => $sortBy
            ]);
                
            return view('frontend.galeri.index', compact('galeri', 'profile'));
        } catch (\Exception $e) {
            \Log::error('Error in Frontend Galeri Index', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat memuat galeri');
        }
    }

    public function show($id)
    {
        $galeri = Galeri::with(['activeItems' => function($query) {
            $query->orderBy('urutan', 'asc');
        }])->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();
            
        // Query galeri lainnya dengan prioritas kategori yang sama, kemudian galeri lainnya
        $galeriLainnya = Galeri::with(['activeItems'])
            ->where('status', 'active')
            ->where('id', '!=', $galeri->id)
            ->orderByRaw("CASE WHEN kategori = ? THEN 0 ELSE 1 END", [$galeri->kategori])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
            
        $profile = Profile::first();
        
        \Log::info('Galeri Show Data', [
            'galeri_id' => $galeri->id,
            'galeri_judul' => $galeri->judul,
            'galeri_kategori' => $galeri->kategori,
            'galeri_lainnya_count' => $galeriLainnya->count(),
            'galeri_lainnya_ids' => $galeriLainnya->pluck('id')->toArray()
        ]);
        
        return view('frontend.galeri.show', compact('galeri', 'galeriLainnya', 'profile'));
    }

    public function apiIndex(Request $request)
    {
        $query = Galeri::with(['activeItems'])->where('status', 'active');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $galeri = $query->paginate(12);
        
        return response()->json($galeri);
    }
}
