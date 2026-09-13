<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramUnggulan;
use Illuminate\Http\Request;

class ProgramUnggulanController extends Controller
{
    public function index()
    {
        $programUnggulan = ProgramUnggulan::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.program-unggulan.index', compact('programUnggulan'));
    }

    public function create()
    {
        return view('admin.program-unggulan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'required|string|max:255',
            'warna' => 'required|string|max:50',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif'
        ], [
            'judul.required' => 'Judul program wajib diisi',
            'deskripsi.required' => 'Deskripsi program wajib diisi',
            'icon.required' => 'Icon program wajib diisi',
            'warna.required' => 'Warna program wajib dipilih',
            'status.required' => 'Status program wajib dipilih'
        ]);

        ProgramUnggulan::create($request->all());

        return redirect()->route('admin.program-unggulan.index')
                        ->with('success', 'Program unggulan berhasil ditambahkan');
    }

    public function edit(ProgramUnggulan $programUnggulan)
    {
        return view('admin.program-unggulan.edit', compact('programUnggulan'));
    }

    public function update(Request $request, ProgramUnggulan $programUnggulan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'required|string|max:255',
            'warna' => 'required|string|max:50',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif'
        ], [
            'judul.required' => 'Judul program wajib diisi',
            'deskripsi.required' => 'Deskripsi program wajib diisi',
            'icon.required' => 'Icon program wajib diisi',
            'warna.required' => 'Warna program wajib dipilih',
            'status.required' => 'Status program wajib dipilih'
        ]);

        $programUnggulan->update($request->all());

        return redirect()->route('admin.program-unggulan.index')
                        ->with('success', 'Program unggulan berhasil diperbarui');
    }

    public function destroy(ProgramUnggulan $programUnggulan)
    {
        $programUnggulan->delete();

        return redirect()->route('admin.program-unggulan.index')
                        ->with('success', 'Program unggulan berhasil dihapus');
    }
}
