<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::withCount('berita')->latest()->paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama',
            'deskripsi' => 'nullable|string',
            'warna' => 'nullable|string|max:7',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['nama', 'deskripsi', 'warna', 'is_active']);
        
        // Set default values
        $data['warna'] = $data['warna'] ?? '#007bff';
        $data['is_active'] = $data['is_active'] ?? true;

        Kategori::create($data);

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        $kategori->load('berita');
        return view('admin.kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string',
            'warna' => 'nullable|string|max:7',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['nama', 'deskripsi', 'warna', 'is_active']);

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        // Cek apakah kategori memiliki berita
        if ($kategori->berita()->count() > 0) {
            return redirect()->route('admin.kategori.index')
                            ->with('error', 'Tidak dapat menghapus kategori yang memiliki berita');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil dihapus');
    }

    /**
     * Store kategori via AJAX (untuk modal di halaman berita)
     */
    public function storeAjax(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama',
            'deskripsi' => 'nullable|string',
            'warna' => 'nullable|string|max:7',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->only(['nama', 'deskripsi', 'warna', 'is_active']);
        
        // Generate slug from nama
        $data['slug'] = \Illuminate\Support\Str::slug($data['nama']);
        
        // Set default values
        $data['warna'] = $data['warna'] ?? '#007bff';
        $data['is_active'] = $data['is_active'] ?? true;

        $kategori = Kategori::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'kategori' => $kategori
        ]);
    }
}
