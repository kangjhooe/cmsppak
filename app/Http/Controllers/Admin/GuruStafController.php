<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruStaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruStafController extends Controller
{
    public function index()
    {
        $guruStaf = GuruStaf::latest()->paginate(10);
        return view('admin.guru-staf.index', compact('guruStaf'));
    }

    public function create()
    {
        return view('admin.guru-staf.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'nullable|string|max:20|unique:guru_staf,nip',
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'mata_pelajaran' => 'nullable|string|max:255',
            'biodata' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru-staf', 'public');
        }

        GuruStaf::create($data);

        return redirect()->route('admin.guru-staf.index')
                        ->with('success', 'Data guru/staf berhasil ditambahkan');
    }

    public function edit(GuruStaf $guruStaf)
    {
        return view('admin.guru-staf.edit', compact('guruStaf'));
    }

    public function update(Request $request, GuruStaf $guruStaf)
    {
        $request->validate([
            'nip' => 'nullable|string|max:20|unique:guru_staf,nip,' . $guruStaf->id,
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'mata_pelajaran' => 'nullable|string|max:255',
            'biodata' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            if ($guruStaf->foto) {
                Storage::delete('public/' . $guruStaf->foto);
            }
            $data['foto'] = $request->file('foto')->store('guru-staf', 'public');
        }

        $guruStaf->update($data);

        return redirect()->route('admin.guru-staf.index')
                        ->with('success', 'Data guru/staf berhasil diperbarui');
    }

    public function destroy(GuruStaf $guruStaf)
    {
        if ($guruStaf->foto) {
            Storage::delete('public/' . $guruStaf->foto);
        }
        
        $guruStaf->delete();

        return redirect()->route('admin.guru-staf.index')
                        ->with('success', 'Data guru/staf berhasil dihapus');
    }
}
