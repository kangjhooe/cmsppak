<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Galeri;
use App\Models\GuruStaf;
use App\Models\Kategori;
use App\Models\Profile;
use App\Models\ProgramUnggulan;
use App\Models\Feature;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori')->published()->latest('published_at')->limit(6)->get();
        
        // Ambil agenda dari 1 bulan terakhir hingga 3 bulan ke depan, termasuk yang sudah selesai
        $agenda = Agenda::where('tanggal_mulai', '>=', \Carbon\Carbon::now()->subMonth())
                         ->where('tanggal_mulai', '<=', \Carbon\Carbon::now()->addMonths(3))
                         ->get();
        
        // Update status untuk setiap agenda
        foreach ($agenda as $item) {
            $item->updateStatusFromTime();
        }
        
        // Urutkan: agenda yang belum selesai di atas, yang sudah selesai di bawah
        $agenda = $agenda->sortBy(function($item) {
            $status = $item->auto_status;
            if ($status === 'completed') {
                return 2; // Prioritas rendah untuk agenda selesai
            } elseif ($status === 'cancelled') {
                return 3; // Prioritas terendah untuk agenda dibatalkan
            } else {
                return 1; // Prioritas tinggi untuk agenda yang belum selesai
            }
        })->values()->take(5);
        
        $guru_staf = GuruStaf::aktif()->limit(8)->get();
        $profile = Profile::first();
        $programUnggulan = ProgramUnggulan::aktif()->urut()->get();
        $features = Feature::aktif()->urut()->get();
        
        // Ambil galeri terbaru dengan activeItems untuk thumbnail
        $galeri = Galeri::with(['activeItems' => function($query) {
            $query->where('status', 'active')->orderBy('urutan', 'asc')->limit(1);
        }])
        ->where('status', 'active')
        ->latest('created_at')
        ->limit(6)
        ->get();

        return view('frontend.home', compact('berita', 'agenda', 'galeri', 'guru_staf', 'profile', 'programUnggulan', 'features'));
    }

    public function profil()
    {
        $profile = Profile::first();
        return view('frontend.profil', compact('profile'));
    }

    public function guruStaf(Request $request)
    {
        $query = GuruStaf::where('status', 'aktif');
        
        // Filter berdasarkan jabatan
        if ($request->has('jabatan') && $request->jabatan) {
            $query->where('jabatan', $request->jabatan);
        }
        
        // Pencarian berdasarkan nama
        if ($request->has('search') && $request->search) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
        }
        
        $guruStaf = $query->orderBy('nama_lengkap', 'asc')->paginate(12);
        
        // Ambil daftar jabatan untuk filter
        $jabatan = GuruStaf::where('status', 'aktif')
            ->distinct()
            ->pluck('jabatan')
            ->filter()
            ->values();
        
        // Statistik untuk semua data (tidak difilter)
        $totalGuruStaf = GuruStaf::where('status', 'aktif')->count();
        $totalGuru = GuruStaf::where('status', 'aktif')
            ->whereRaw('LOWER(jabatan) = ?', ['guru'])
            ->count();
        $totalStaf = GuruStaf::where('status', 'aktif')
            ->whereRaw('LOWER(jabatan) != ?', ['guru'])
            ->count();
            
        $profile = Profile::first();
        
        return view('frontend.guru-staf.index', compact('guruStaf', 'jabatan', 'profile', 'totalGuruStaf', 'totalGuru', 'totalStaf'));
    }

    public function berita()
    {
        $berita = Berita::with(['user', 'kategori'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(12);
        
        // Get categories for filter dropdown
        $kategoris = Kategori::whereHas('berita', function($q) {
            $q->where('status', 'published')
              ->where('published_at', '<=', now());
        })->orderBy('nama')->get();
        
        $profile = Profile::first();
        return view('frontend.berita.index', compact('berita', 'kategoris', 'profile'));
    }

    public function beritaDetail($slug)
    {
        $berita = Berita::published()->where('slug', $slug)->firstOrFail();
        $berita_terkait = Berita::published()->where('id', '!=', $berita->id)->limit(3)->get();
        $profile = Profile::first();
        
        return view('frontend.berita.show', compact('berita', 'berita_terkait', 'profile'));
    }

    public function agenda()
    {
        // Ambil agenda dari 1 bulan terakhir hingga 3 bulan ke depan, termasuk yang sudah selesai
        $agenda = Agenda::where('tanggal_mulai', '>=', \Carbon\Carbon::now()->subMonth())
                         ->where('tanggal_mulai', '<=', \Carbon\Carbon::now()->addMonths(3))
                         ->get();
        
        // Update status untuk setiap agenda
        foreach ($agenda as $item) {
            $item->updateStatusFromTime();
        }
        
        // Urutkan: agenda yang belum selesai di atas, yang sudah selesai di bawah
        $agenda = $agenda->sortBy(function($item) {
            $status = $item->auto_status;
            if ($status === 'completed') {
                return 2; // Prioritas rendah untuk agenda selesai
            } elseif ($status === 'cancelled') {
                return 3; // Prioritas terendah untuk agenda dibatalkan
            } else {
                return 1; // Prioritas tinggi untuk agenda yang belum selesai
            }
        })->values();
        
        // Paginate manual
        $perPage = 12;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = $agenda->slice($offset, $perPage)->values();
        
        $agenda = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $agenda->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );
        
        $profile = Profile::first();
        return view('frontend.agenda', compact('agenda', 'profile'));
    }

    public function galeri()
    {
        try {
            // Query galeri dengan eager loading activeItems
            $galeri = \App\Models\Galeri::with(['activeItems' => function($query) {
                $query->where('status', 'active')->orderBy('urutan', 'asc');
            }])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
                
            $profile = Profile::first();
            
            // Log untuk debugging
            \Log::info('Frontend Galeri Data', [
                'total_galeri' => $galeri->total(),
                'current_page' => $galeri->currentPage(),
                'per_page' => $galeri->perPage(),
                'first_galeri_id' => $galeri->first() ? $galeri->first()->id : null,
                'first_galeri_created' => $galeri->first() ? $galeri->first()->created_at : null
            ]);
            
            return view('frontend.galeri.index', compact('galeri', 'profile'));
        } catch (\Exception $e) {
            \Log::error('Error in Frontend Galeri', ['error' => $e->getMessage()]);
            
            // Fallback dengan data kosong
            $galeri = collect([]);
            $profile = Profile::first();
            
            return view('frontend.galeri.index', compact('galeri', 'profile'));
        }
    }

    public function kontak()
    {
        $profile = Profile::first();
        return view('frontend.kontak', compact('profile'));
    }

    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|max:2000',
            'setuju' => 'required|accepted'
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'subjek.required' => 'Subjek wajib dipilih',
            'pesan.required' => 'Pesan wajib diisi',
            'pesan.max' => 'Pesan maksimal 2000 karakter',
            'setuju.required' => 'Anda harus menyetujui kebijakan privasi',
            'setuju.accepted' => 'Anda harus menyetujui kebijakan privasi'
        ]);

        // Simpan pesan ke database (bisa menggunakan model BukuTamu atau membuat model baru)
        \App\Models\BukuTamu::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'instansi' => 'Kontak Website',
            'pesan' => "Subjek: " . $request->subjek . "\n\n" . $request->pesan
        ]);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim. Kami akan merespons dalam waktu 1-2 hari kerja.');
    }
}
