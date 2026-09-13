<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with(['user', 'kategori'])->latest()->paginate(10);
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = Kategori::active()->get();
        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'konten' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'kategori_id' => 'nullable|array',
            'kategori_id.*' => 'exists:kategori,id',
            'published_at' => 'nullable|date'
        ]);

        $data = $request->except(['gambar_utama', 'published_at', 'kategori_id']);
        $data['user_id'] = auth()->id();
        
        // Generate unique slug
        if ($request->slug && !empty($request->slug)) {
            $baseSlug = Str::slug($request->slug);
        } else {
            $baseSlug = Str::slug($request->judul);
        }
        
        $slug = $baseSlug;
        $counter = 1;
        
        while (Berita::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        $data['slug'] = $slug;
        
        // Set published_at based on status and input
        if ($request->status === 'published') {
            if (empty($request->published_at)) {
                // If published but no published_at specified, set to now
                $data['published_at'] = now();
            } else {
                // Use the specified published_at
                $data['published_at'] = $request->published_at;
            }
        } else {
            // For draft status, don't set published_at
            $data['published_at'] = null;
        }
        
        if ($request->hasFile('gambar_utama')) {
            $data['gambar_utama'] = $request->file('gambar_utama')->store('berita', 'public');
        }

        $berita = Berita::create($data);
        
        // Sync kategori
        if ($request->has('kategori_id')) {
            $berita->kategori()->sync($request->kategori_id);
        }

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita berhasil ditambahkan');
    }

    public function show(Berita $berita)
    {
        $berita->load(['user', 'kategori']);
        return view('admin.berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        $kategori = Kategori::active()->get();
        $berita->load('kategori');
        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'konten' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'kategori_id' => 'nullable|array',
            'kategori_id.*' => 'exists:kategori,id',
            'published_at' => 'nullable|date'
        ]);

        $data = $request->except(['gambar_utama', 'published_at', 'kategori_id']);
        
        // Generate unique slug (check if title or slug changed)
        if ($request->judul !== $berita->judul || ($request->slug && $request->slug !== $berita->slug)) {
            if ($request->slug && !empty($request->slug)) {
                $baseSlug = Str::slug($request->slug);
            } else {
                $baseSlug = Str::slug($request->judul);
            }
            
            $slug = $baseSlug;
            $counter = 1;
            
            while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $data['slug'] = $slug;
        }
        
        // Set published_at based on status and input
        if ($request->status === 'published') {
            if (empty($request->published_at)) {
                // If published but no published_at specified, set to now
                $data['published_at'] = now();
            } else {
                // Use the specified published_at
                $data['published_at'] = $request->published_at;
            }
        } else {
            // For draft status, don't set published_at
            $data['published_at'] = null;
        }
        
        if ($request->hasFile('gambar_utama')) {
            if ($berita->gambar_utama) {
                Storage::delete('public/' . $berita->gambar_utama);
            }
            $data['gambar_utama'] = $request->file('gambar_utama')->store('berita', 'public');
        }

        $berita->update($data);
        
        // Sync kategori
        if ($request->has('kategori_id')) {
            $berita->kategori()->sync($request->kategori_id);
        } else {
            $berita->kategori()->detach();
        }

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar_utama) {
            Storage::delete('public/' . $berita->gambar_utama);
        }
        
        $berita->delete();

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita berhasil dihapus');
    }
}
