<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\GaleriItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GaleriItemController extends Controller
{
    public function create(Galeri $galeri)
    {
        try {
            Log::info('GaleriItem create form accessed', ['galeri_id' => $galeri->id]);
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
                'file' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'thumbnail' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'urutan' => 'nullable|integer|min:1',
                'status' => 'required|in:active,inactive'
            ]);

            $data = [
                'galeri_id' => $galeri->id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'jenis' => 'foto',
                'urutan' => $request->urutan ?? 1,
                'status' => $request->status
            ];

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('galeri', $filename, 'public');
                $data['file_path'] = $path;
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = 'thumb_' . time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnailPath = $thumbnail->storeAs('galeri/thumbnails', $thumbnailName, 'public');
                $data['thumbnail'] = $thumbnailPath;
            }

            $galeriItem = GaleriItem::create($data);

            Log::info('GaleriItem created successfully', [
                'id' => $galeriItem->id,
                'galeri_id' => $galeri->id,
                'judul' => $request->judul
            ]);

            return redirect()->route('admin.galeri.edit', $galeri)
                            ->with('success', 'Media item berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error creating galeri item', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan media item: ' . $e->getMessage());
        }
    }

    public function edit(GaleriItem $galeriItem)
    {
        try {
            Log::info('GaleriItem edit form accessed', ['id' => $galeriItem->id]);
            return view('admin.galeri.items.edit', compact('galeriItem'));
        } catch (\Exception $e) {
            Log::error('Error accessing galeri item edit form', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat membuka form edit media item');
        }
    }

    public function update(Request $request, GaleriItem $galeriItem)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'thumbnail' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'urutan' => 'nullable|integer|min:1',
                'status' => 'required|in:active,inactive'
            ]);

            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'jenis' => 'foto',
                'urutan' => $request->urutan ?? $galeriItem->urutan,
                'status' => $request->status
            ];

            // Handle file upload
            if ($request->hasFile('file')) {
                // Delete old file
                if ($galeriItem->file_path) {
                    Storage::disk('public')->delete($galeriItem->file_path);
                }
                
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('galeri', $filename, 'public');
                $data['file_path'] = $path;
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($galeriItem->thumbnail) {
                    Storage::disk('public')->delete($galeriItem->thumbnail);
                }
                
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = 'thumb_' . time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnailPath = $thumbnail->storeAs('galeri/thumbnails', $thumbnailName, 'public');
                $data['thumbnail'] = $thumbnailPath;
            }

            $galeriItem->update($data);

            Log::info('GaleriItem updated successfully', [
                'id' => $galeriItem->id,
                'judul' => $request->judul
            ]);

            return redirect()->route('admin.galeri.edit', $galeriItem->galeri)
                            ->with('success', 'Media item berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating galeri item', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui media item: ' . $e->getMessage());
        }
    }

    public function destroy(GaleriItem $galeriItem)
    {
        try {
            $galeriId = $galeriItem->galeri_id;
            
            // Delete files
            if ($galeriItem->file_path) {
                Storage::disk('public')->delete($galeriItem->file_path);
            }
            if ($galeriItem->thumbnail) {
                Storage::disk('public')->delete($galeriItem->thumbnail);
            }
            
            $galeriItem->delete();
            
            Log::info('GaleriItem deleted successfully', ['id' => $galeriItem->id]);

            return redirect()->route('admin.galeri.edit', $galeriId)
                            ->with('success', 'Media item berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting galeri item', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus media item: ' . $e->getMessage());
        }
    }
}