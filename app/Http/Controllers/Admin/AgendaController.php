<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::query()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jenis')) {
            $jenis = $request->jenis === 'non-akademik' ? 'non_akademik' : $request->jenis;
            $query->where('jenis', $jenis);
        }

        if ($request->filled('status')) {
            $query->byAutoStatus($request->status);
        }

        $agenda = $query->paginate(10)->withQueryString();

        $stats = [
            'total' => Agenda::count(),
            'upcoming' => Agenda::byAutoStatus('upcoming')->count(),
            'ongoing' => Agenda::byAutoStatus('ongoing')->count(),
            'completed' => Agenda::byAutoStatus('completed')->count(),
        ];

        return view('admin.agenda.index', compact('agenda', 'stats'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'jenis' => 'required|in:akademik,non_akademik,umum',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled'
        ]);

        // Custom validation untuk kombinasi tanggal dan waktu
        if ($request->tanggal_mulai == $request->tanggal_selesai) {
            // Jika tanggal sama, waktu selesai harus setelah waktu mulai
            if ($request->waktu_selesai <= $request->waktu_mulai) {
                return back()->withErrors(['waktu_selesai' => 'Jika tanggal sama, waktu selesai harus setelah waktu mulai.'])->withInput();
            }
        }

        // Gabungkan tanggal dan waktu untuk field waktu_mulai dan waktu_selesai
        $data = $request->all();
        
        // Gunakan tanggal_selesai jika ada, jika tidak gunakan tanggal_mulai
        $tanggalSelesai = $request->tanggal_selesai ?: $request->tanggal_mulai;
        
        $data['waktu_mulai'] = $request->tanggal_mulai . ' ' . $request->waktu_mulai . ':00';
        $data['waktu_selesai'] = $tanggalSelesai . ' ' . $request->waktu_selesai . ':00';

        Agenda::create($data);

        return redirect()->route('admin.agenda.index')
                        ->with('success', 'Agenda berhasil ditambahkan');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'jenis' => 'required|in:akademik,non_akademik,umum',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled'
        ]);

        // Custom validation untuk kombinasi tanggal dan waktu
        if ($request->tanggal_mulai == $request->tanggal_selesai) {
            // Jika tanggal sama, waktu selesai harus setelah waktu mulai
            if ($request->waktu_selesai <= $request->waktu_mulai) {
                return back()->withErrors(['waktu_selesai' => 'Jika tanggal sama, waktu selesai harus setelah waktu mulai.'])->withInput();
            }
        }

        // Gabungkan tanggal dan waktu untuk field waktu_mulai dan waktu_selesai
        $data = $request->all();
        
        // Gunakan tanggal_selesai jika ada, jika tidak gunakan tanggal_mulai
        $tanggalSelesai = $request->tanggal_selesai ?: $request->tanggal_mulai;
        
        $data['waktu_mulai'] = $request->tanggal_mulai . ' ' . $request->waktu_mulai . ':00';
        $data['waktu_selesai'] = $tanggalSelesai . ' ' . $request->waktu_selesai . ':00';

        $agenda->update($data);

        return redirect()->route('admin.agenda.index')
                        ->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('admin.agenda.index')
                        ->with('success', 'Agenda berhasil dihapus');
    }
}
