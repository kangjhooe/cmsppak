<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\GaleriItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class GaleriItemController extends Controller
{
    public function create(Galeri $galeri)
    {
        try {
            return view('admin.galeri.items.create', compact('galeri'));
        } catch (\Exception $e) {
            Log::error('Error accessing galeri item create form', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat membuka form tambah media item');
        }
    }

    public function store(Request $request, Galeri $galeri)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'jenis' => 'required|in:foto,video,youtube',
                'file' => [
                    Rule::requiredIf(fn () => in_array($request->jenis, ['foto', 'video'], true)),
                    'nullable',
                    'file',
                    'mimes:jpeg,png,jpg,gif,webp,mp4,avi,mov,wmv',
                    'max:10240',
                ],
                'youtube_url' => [
                    Rule::requiredIf(fn () => $request->jenis === 'youtube'),
                    'nullable',
                    'string',
                    'max:500',
                ],
                'thumbnail' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'urutan' => 'nullable|integer|min:1',
                'status' => 'required|in:active,inactive'
            ]);

            if ($galeri->items()->count() >= 12) {
                return back()->withInput()->with('error', 'Maksimal 12 media per galeri');
            }

            $data = [
                'galeri_id' => $galeri->id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'jenis' => $request->jenis,
                'urutan' => $request->urutan ?? (($galeri->items()->max('urutan') ?? 0) + 1),
                'status' => $request->status,
                'file_path' => null,
                'youtube_url' => null,
            ];

            if ($request->jenis === 'youtube') {
                $normalized = GaleriItem::normalizeYoutubeUrl($request->youtube_url);
                if (!$normalized) {
                    return back()->withInput()->withErrors([
                        'youtube_url' => 'URL YouTube tidak valid. Gunakan format youtube.com/watch?v=... atau youtu.be/...'
                    ]);
                }
                $data['youtube_url'] = $normalized;
            } elseif ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $data['file_path'] = $file->storeAs('galeri', $filename, 'public');
            }

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = 'thumb_' . time() . '_' . $thumbnail->getClientOriginalName();
                $data['thumbnail'] = $thumbnail->storeAs('galeri/thumbnails', $thumbnailName, 'public');
            }

            GaleriItem::create($data);

            return redirect()->route('admin.galeri.edit', $galeri)
                            ->with('success', 'Media item berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error creating galeri item', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan media item: ' . $e->getMessage());
        }
    }

    public function edit(Galeri $galeri, GaleriItem $galeriItem)
    {
        try {
            if ($galeriItem->galeri_id !== $galeri->id) {
                abort(404);
            }
            return view('admin.galeri.items.edit', compact('galeri', 'galeriItem'));
        } catch (\Exception $e) {
            Log::error('Error accessing galeri item edit form', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat membuka form edit media item');
        }
    }

    public function update(Request $request, Galeri $galeri, GaleriItem $galeriItem)
    {
        if ($galeriItem->galeri_id !== $galeri->id) {
            abort(404);
        }

        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,avi,mov,wmv|max:10240',
                'youtube_url' => [
                    Rule::requiredIf(fn () => $galeriItem->jenis === 'youtube'),
                    'nullable',
                    'string',
                    'max:500',
                ],
                'thumbnail' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'urutan' => 'nullable|integer|min:1',
                'status' => 'required|in:active,inactive'
            ]);

            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'urutan' => $request->urutan ?? $galeriItem->urutan,
                'status' => $request->status
            ];

            if ($galeriItem->jenis === 'youtube') {
                $normalized = GaleriItem::normalizeYoutubeUrl($request->youtube_url);
                if (!$normalized) {
                    return back()->withInput()->withErrors([
                        'youtube_url' => 'URL YouTube tidak valid.'
                    ]);
                }
                $data['youtube_url'] = $normalized;
            }

            if ($request->hasFile('file') && in_array($galeriItem->jenis, ['foto', 'video'], true)) {
                if ($galeriItem->file_path) {
                    Storage::disk('public')->delete($galeriItem->file_path);
                }

                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $data['file_path'] = $file->storeAs('galeri', $filename, 'public');
            }

            if ($request->hasFile('thumbnail')) {
                if ($galeriItem->thumbnail) {
                    Storage::disk('public')->delete($galeriItem->thumbnail);
                }

                $thumbnail = $request->file('thumbnail');
                $thumbnailName = 'thumb_' . time() . '_' . $thumbnail->getClientOriginalName();
                $data['thumbnail'] = $thumbnail->storeAs('galeri/thumbnails', $thumbnailName, 'public');
            }

            $galeriItem->update($data);

            return redirect()->route('admin.galeri.edit', $galeri)
                            ->with('success', 'Media item berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating galeri item', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui media item: ' . $e->getMessage());
        }
    }

    public function destroy(Galeri $galeri, GaleriItem $galeriItem)
    {
        try {
            if ($galeriItem->galeri_id !== $galeri->id) {
                abort(404);
            }

            $galeriId = $galeriItem->galeri_id;

            if ($galeriItem->file_path) {
                Storage::disk('public')->delete($galeriItem->file_path);
            }
            if ($galeriItem->thumbnail) {
                Storage::disk('public')->delete($galeriItem->thumbnail);
            }

            $galeriItem->delete();

            return redirect()->route('admin.galeri.edit', $galeriId)
                            ->with('success', 'Media item berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting galeri item', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus media item: ' . $e->getMessage());
        }
    }
}
