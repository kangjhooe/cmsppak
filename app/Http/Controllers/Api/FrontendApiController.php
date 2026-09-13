<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Galeri;
use App\Models\GuruStaf;
use App\Models\Profile;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FrontendApiController extends Controller
{
    /**
     * Get berita dengan pagination
     */
    public function getBerita(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 6);
        $category = $request->get('category');
        $search = $request->get('search');

        $query = Berita::published();

        if ($category) {
            $query->where('kategori', $category);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        $berita = $query->latest('published_at')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $berita->items(),
            'pagination' => [
                'current_page' => $berita->currentPage(),
                'last_page' => $berita->lastPage(),
                'per_page' => $berita->perPage(),
                'total' => $berita->total(),
                'from' => $berita->firstItem(),
                'to' => $berita->lastItem(),
            ]
        ]);
    }

    /**
     * Get detail berita
     */
    public function getBeritaDetail($slug): JsonResponse
    {
        $berita = Berita::published()->where('slug', $slug)->first();

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan'
            ], 404);
        }

        // Increment view count (optional)
        $berita->increment('view_count');

        return response()->json([
            'success' => true,
            'data' => $berita
        ]);
    }

    /**
     * Get agenda dengan filter
     */
    public function getAgenda(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 10);
        $type = $request->get('type');
        $month = $request->get('month');
        $year = $request->get('year');

        $query = Agenda::query();

        if ($type) {
            $query->where('jenis', $type);
        }

        if ($month && $year) {
            $query->byMonth($month, $year);
        }

        $agenda = $query->orderBy('tanggal_mulai')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $agenda->items(),
            'pagination' => [
                'current_page' => $agenda->currentPage(),
                'last_page' => $agenda->lastPage(),
                'per_page' => $agenda->perPage(),
                'total' => $agenda->total(),
            ]
        ]);
    }

    /**
     * Get galeri dengan filter
     */
    public function getGaleri(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 12);
        $type = $request->get('type');

        $query = Galeri::where('status', 'active');

        if ($type) {
            $query->where('jenis', $type);
        }

        $galeri = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $galeri->items(),
            'pagination' => [
                'current_page' => $galeri->currentPage(),
                'last_page' => $galeri->lastPage(),
                'per_page' => $galeri->perPage(),
                'total' => $galeri->total(),
            ]
        ]);
    }

    /**
     * Get guru dan staf
     */
    public function getGuruStaf(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $status = $request->get('status', 'aktif');

        $guruStaf = GuruStaf::where('status', $status)
                            ->orderBy('jabatan')
                            ->orderBy('nama_lengkap')
                            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $guruStaf->items(),
            'pagination' => [
                'current_page' => $guruStaf->currentPage(),
                'last_page' => $guruStaf->lastPage(),
                'per_page' => $guruStaf->perPage(),
                'total' => $guruStaf->total(),
            ]
        ]);
    }

    /**
     * Get profile sekolah
     */
    public function getProfile(): JsonResponse
    {
        $profile = Profile::first();

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile sekolah tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $profile
        ]);
    }

    /**
     * Get downloads
     */
    public function getDownloads(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $category = $request->get('category');

        $query = Download::active();

        if ($category) {
            $query->byCategory($category);
        }

        $downloads = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $downloads->items(),
            'pagination' => [
                'current_page' => $downloads->currentPage(),
                'last_page' => $downloads->lastPage(),
                'per_page' => $downloads->perPage(),
                'total' => $downloads->total(),
            ]
        ]);
    }

    /**
     * Increment download count
     */
    public function incrementDownload($id): JsonResponse
    {
        $download = Download::find($id);

        if (!$download) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak ditemukan'
            ], 404);
        }

        $download->incrementDownload();

        return response()->json([
            'success' => true,
            'message' => 'Download count berhasil diupdate',
            'data' => [
                'id' => $download->id,
                'jumlah_download' => $download->jumlah_download
            ]
        ]);
    }

    /**
     * Search global
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');
        $type = $request->get('type', 'all');

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Query pencarian diperlukan'
            ], 400);
        }

        $results = [];

        if ($type === 'all' || $type === 'berita') {
            $berita = Berita::published()
                           ->where('judul', 'like', "%{$query}%")
                           ->orWhere('ringkasan', 'like', "%{$query}%")
                           ->limit(5)
                           ->get(['id', 'judul', 'slug', 'ringkasan', 'published_at']);
            
            $results['berita'] = $berita;
        }

        if ($type === 'all' || $type === 'agenda') {
            $agenda = Agenda::where('judul', 'like', "%{$query}%")
                           ->orWhere('deskripsi', 'like', "%{$query}%")
                           ->limit(5)
                           ->get(['id', 'judul', 'deskripsi', 'tanggal_mulai']);
            
            $results['agenda'] = $agenda;
        }

        if ($type === 'all' || $type === 'guru_staf') {
            $guruStaf = GuruStaf::where('nama_lengkap', 'like', "%{$query}%")
                                ->orWhere('jabatan', 'like', "%{$query}%")
                                ->limit(5)
                                ->get(['id', 'nama_lengkap', 'jabatan', 'mata_pelajaran']);
            
            $results['guru_staf'] = $guruStaf;
        }

        return response()->json([
            'success' => true,
            'data' => $results,
            'query' => $query
        ]);
    }
}
