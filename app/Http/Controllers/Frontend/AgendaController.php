<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Profile;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::query();
        
        if ($request->has('bulan')) {
            $bulan = $request->bulan;
            $tahun = $request->tahun ?? date('Y');
            $query->whereMonth('tanggal_mulai', $bulan)
                  ->whereYear('tanggal_mulai', $tahun);
        } else {
            // Tampilkan agenda dari 3 bulan terakhir hingga 3 bulan ke depan
            $query->where('tanggal_mulai', '>=', Carbon::now()->subMonths(3))
                  ->where('tanggal_mulai', '<=', Carbon::now()->addMonths(3));
        }
        
        // Update status untuk setiap agenda yang ditampilkan
        $agenda = $query->get();
        foreach ($agenda as $item) {
            $item->updateStatusFromTime();
        }
        
        // Urutkan: agenda yang belum selesai di atas (upcoming, ongoing), yang sudah selesai di bawah (completed)
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
        $currentPage = $request->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = $agenda->slice($offset, $perPage)->values();
        
        $agenda = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $agenda->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'pageName' => 'page']
        );
        
        $profile = Profile::first();
        
        $bulanList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        return view('frontend.agenda.index', compact('agenda', 'bulanList', 'profile'));
    }

    public function show($id)
    {
        $agenda = Agenda::where('id', $id)->firstOrFail();
        
        // Update status agenda secara otomatis berdasarkan waktu saat ini
        $agenda->updateStatusFromTime();
        
        $agendaTerdekat = Agenda::where('id', '!=', $agenda->id)
            ->where('tanggal_mulai', '>=', Carbon::now())
            ->orderBy('tanggal_mulai', 'asc')
            ->limit(5)
            ->get();
            
        $profile = Profile::first();
        
        return view('frontend.agenda.show', compact('agenda', 'agendaTerdekat', 'profile'));
    }

    public function apiIndex(Request $request)
    {
        $query = Agenda::query();
        
        if ($request->has('month')) {
            $month = $request->month;
            $year = $request->year ?? now()->year;
            $query->whereMonth('tanggal_mulai', $month)
                  ->whereYear('tanggal_mulai', $year);
        }
        
        $agenda = $query->orderBy('tanggal_mulai', 'asc')->paginate(10);
        
        return response()->json($agenda);
    }
}
