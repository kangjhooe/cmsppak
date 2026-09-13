<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
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
            'judul.required' => 'Judul fitur wajib diisi',
            'deskripsi.required' => 'Deskripsi fitur wajib diisi',
            'icon.required' => 'Icon fitur wajib diisi',
            'warna.required' => 'Warna fitur wajib dipilih',
            'status.required' => 'Status fitur wajib dipilih'
        ]);

        Feature::create($request->all());

        return redirect()->route('admin.features.index')
                        ->with('success', 'Fitur berhasil ditambahkan');
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'required|string|max:255',
            'warna' => 'required|string|max:50',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif'
        ], [
            'judul.required' => 'Judul fitur wajib diisi',
            'deskripsi.required' => 'Deskripsi fitur wajib diisi',
            'icon.required' => 'Icon fitur wajib diisi',
            'warna.required' => 'Warna fitur wajib dipilih',
            'status.required' => 'Status fitur wajib dipilih'
        ]);

        $feature->update($request->all());

        return redirect()->route('admin.features.index')
                        ->with('success', 'Fitur berhasil diperbarui');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->route('admin.features.index')
                        ->with('success', 'Fitur berhasil dihapus');
    }
}
