<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\GuruStaf;
use App\Models\Agenda;
use App\Models\BukuTamu;
use App\Models\Download;
use App\Models\GaleriItem;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik dasar
        $data = [
            'total_users' => User::count(),
            'total_berita' => Berita::count(),
            'total_guru_staf' => GuruStaf::count(),
            'total_agenda' => Agenda::count(),
            'total_downloads' => Download::count(),
            'total_buku_tamu' => BukuTamu::count(),
            
            // Statistik berita
            'berita_published' => Berita::where('status', 'published')->count(),
            'berita_draft' => Berita::where('status', 'draft')->count(),
            'berita_terbaru' => Berita::latest()->limit(5)->get(),
            
            // Statistik agenda
            'agenda_upcoming' => Agenda::where('status', 'upcoming')->count(),
            'agenda_ongoing' => Agenda::where('status', 'ongoing')->count(),
            'agenda_completed' => Agenda::where('status', 'completed')->count(),
            'agenda_terdekat' => Agenda::where('status', 'upcoming')
                ->where('tanggal_mulai', '>=', Carbon::today())
                ->orderBy('tanggal_mulai')
                ->limit(5)
                ->get(),
            
            // Statistik guru & staf
            'guru_staf_aktif' => GuruStaf::where('status', 'aktif')->count(),
            'guru_staf_nonaktif' => GuruStaf::where('status', 'nonaktif')->count(),
            
            // Statistik galeri
            'galeri_foto' => GaleriItem::where('jenis', 'foto')->where('status', 'active')->count(),
            
            // Statistik downloads
            'downloads_aktif' => Download::where('is_active', true)->count(),
            'downloads_nonaktif' => Download::where('is_active', false)->count(),
            'downloads_terbaru' => Download::latest()->limit(5)->get(),
            
            // Statistik buku tamu
            'pesan_baru' => BukuTamu::where('status', 'unread')->count(),
            'pesan_sudah_dibaca' => BukuTamu::where('status', 'read')->count(),
            'pesan_sudah_dibalas' => BukuTamu::where('status', 'replied')->count(),
            'pesan_terbaru' => BukuTamu::latest()->limit(5)->get(),
            
            // Statistik bulanan
            'berita_bulan_ini' => Berita::whereMonth('created_at', Carbon::now()->month)->count(),
            'agenda_bulan_ini' => Agenda::whereMonth('tanggal_mulai', Carbon::now()->month)->count(),
            'downloads_bulan_ini' => Download::whereMonth('created_at', Carbon::now()->month)->count(),
            
            // Top downloads
            'top_downloads' => Download::orderBy('jumlah_download', 'desc')->limit(5)->get(),
            
            // Recent activities
            'recent_users' => User::latest()->limit(5)->get(),
        ];

        return view('admin.dashboard', compact('data'));
    }
}
