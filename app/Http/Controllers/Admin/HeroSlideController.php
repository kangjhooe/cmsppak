<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index(Request $request)
    {
        $query = HeroSlide::urut();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('subjudul', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $slides = $query->paginate(12)->withQueryString();

        $stats = [
            'total' => HeroSlide::count(),
            'aktif' => HeroSlide::where('status', 'aktif')->count(),
            'nonaktif' => HeroSlide::where('status', 'nonaktif')->count(),
        ];

        return view('admin.hero-slides.index', compact('slides', 'stats'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['tampilkan_teks'] = $request->boolean('tampilkan_teks');
        $data['gambar'] = $request->file('gambar')->store('hero-slides', 'public');

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Slide hero berhasil ditambahkan');
    }

    public function edit(HeroSlide $hero_slide)
    {
        return view('admin.hero-slides.edit', ['slide' => $hero_slide]);
    }

    public function show(HeroSlide $hero_slide)
    {
        return redirect()->route('admin.hero-slides.edit', $hero_slide);
    }

    public function update(Request $request, HeroSlide $hero_slide)
    {
        $data = $this->validated($request, false);
        $data['tampilkan_teks'] = $request->boolean('tampilkan_teks');
        unset($data['gambar']);

        if ($request->hasFile('gambar')) {
            if ($hero_slide->gambar && Storage::disk('public')->exists($hero_slide->gambar)) {
                Storage::disk('public')->delete($hero_slide->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('hero-slides', 'public');
        }

        $hero_slide->update($data);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Slide hero berhasil diperbarui');
    }

    public function destroy(HeroSlide $hero_slide)
    {
        if ($hero_slide->gambar && Storage::disk('public')->exists($hero_slide->gambar)) {
            Storage::disk('public')->delete($hero_slide->gambar);
        }

        $hero_slide->delete();

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Slide hero berhasil dihapus');
    }

    protected function validated(Request $request, bool $requireImage = true): array
    {
        return $request->validate([
            'judul' => 'nullable|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'gambar' => ($requireImage ? 'required' : 'nullable') . '|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'link_url' => 'nullable|url|max:500',
            'link_teks' => 'nullable|string|max:100',
            'tampilkan_teks' => 'nullable|boolean',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'gambar.required' => 'Gambar slide wajib diunggah',
            'gambar.image' => 'File harus berupa gambar',
            'status.required' => 'Status wajib dipilih',
        ]);
    }
}
