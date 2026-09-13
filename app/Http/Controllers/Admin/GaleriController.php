<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GaleriController extends Controller
{
    public function index()
    {
        try {
            $galeri = Galeri::withCount('activeItems')->latest()->paginate(12);
            Log::info('Galeri index accessed successfully', ['count' => $galeri->count()]);
            return view('admin.galeri.index', compact('galeri'));
        } catch (\Exception $e) {
            Log::error('Error accessing galeri index', ['error' => $e->getMessage()]);
            // Return empty collection as fallback
            $galeri = collect([]);
            return view('admin.galeri.index', compact('galeri'));
        }
    }

    public function create()
    {
        try {
            Log::info('Galeri create form accessed', [
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'user_roles' => auth()->user()->roles->pluck('name'),
                'timestamp' => now()
            ]);
            return view('admin.galeri.create');
        } catch (\Exception $e) {
            Log::error('Error accessing galeri create form', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => auth()->id()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat membuka form tambah galeri');
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info('Galeri store request received', [
                'request_data' => $request->all(),
                'files_count' => $request->hasFile('media_files') ? count($request->file('media_files')) : 0,
                'media_titles' => $request->input('media_titles', []),
                'media_orders' => $request->input('media_orders', [])
            ]);

            // Validate basic galeri data first
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'kategori' => 'nullable|string|max:100',
                'status' => 'required|in:active,inactive',
                'media_files' => 'required|array|min:4|max:12',
                'media_files.*' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB max, hanya gambar
                'media_titles' => 'nullable|array|max:12',
                'media_titles.*' => 'nullable|string|max:255',
                'media_orders' => 'nullable|array|max:12',
                'media_orders.*' => 'nullable|integer|min:1'
            ]);

            // Get form data
            $mediaFiles = $request->file('media_files', []);
            $mediaTitles = $request->input('media_titles', []);
            $mediaOrders = $request->input('media_orders', []);

            // Validate media items
            $validMediaCount = 0;
            foreach ($mediaFiles as $file) {
                if ($file && $file->isValid()) {
                    $validMediaCount++;
                }
            }

            // Require minimum 4 media
            if ($validMediaCount < 4) {
                return back()->withInput()->with('error', 'Minimal 4 foto harus diupload');
            }

            Log::info('Processing media items', [
                'files_count' => count($mediaFiles),
                'valid_media_count' => $validMediaCount
            ]);

            // Create galeri
            $galeri = Galeri::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'status' => $request->status
            ]);

            Log::info('Galeri created', ['galeri_id' => $galeri->id]);

            // Process media items
            $processedCount = 0;
            
            foreach ($mediaFiles as $index => $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }
                
                $title = $mediaTitles[$index] ?? "Foto " . ($index + 1);
                $order = (int) ($mediaOrders[$index] ?? ($index + 1));

                Log::info('Processing photo file', [
                    'index' => $index,
                    'filename' => $file->getClientOriginalName(),
                    'title' => $title,
                    'order' => $order
                ]);

                // Upload and process file
                $filePath = $this->processAndStoreFile($file, $galeri->kategori, 'foto');

                // Create galeri item
                $galeriItem = \App\Models\GaleriItem::create([
                    'galeri_id' => $galeri->id,
                    'judul' => $title,
                    'deskripsi' => '',
                    'jenis' => 'foto',
                    'file_path' => $filePath,
                    'thumbnail' => null,
                    'urutan' => $order,
                    'status' => 'active'
                ]);

                Log::info('Galeri item created', [
                    'item_id' => $galeriItem->id,
                    'file_path' => $filePath
                ]);

                $processedCount++;
            }

            // Require minimum 4 media
            if ($processedCount < 4) {
                return back()->withInput()->with('error', 'Minimal 4 foto harus diproses dan tersimpan');
            }

            Log::info('Galeri multi-media created successfully', [
                'galeri_id' => $galeri->id,
                'judul' => $galeri->judul,
                'media_count' => $processedCount
            ]);

            return redirect()->route('admin.galeri.index')
                            ->with('success', 'Galeri berhasil dibuat dengan ' . $processedCount . ' media');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in galeri store', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Error creating galeri multi-media', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan galeri: ' . $e->getMessage());
        }
    }

    /**
     * Process and store file without auto-crop
     */
    private function processAndStoreFile($file, $kategori, $type)
    {
        $folder = 'galeri/' . ($kategori ?: 'umum');
        
        // Store all files as is without cropping
        return $file->store($folder, 'public');
    }


    public function edit(Galeri $galeri)
    {
        try {
            // Load items relationship
            $galeri->load('items');
            Log::info('Galeri edit form accessed', ['id' => $galeri->id, 'items_count' => $galeri->items->count()]);
            return view('admin.galeri.edit', compact('galeri'));
        } catch (\Exception $e) {
            Log::error('Error accessing galeri edit form', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat membuka form edit galeri');
        }
    }

    public function update(Request $request, Galeri $galeri)
    {
        try {
            Log::info('Galeri update request received', [
                'galeri_id' => $galeri->id,
                'request_data' => $request->all(),
                'files_count' => $request->hasFile('media_files') ? count($request->file('media_files')) : 0,
                'media_titles' => $request->input('media_titles', []),
                'media_orders' => $request->input('media_orders', [])
            ]);

            // Validate basic galeri data first
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'kategori' => 'nullable|string|max:100',
                'status' => 'required|in:active,inactive',
                'media_files' => 'nullable|array|max:12',
                'media_files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB max, hanya gambar
                'media_titles' => 'nullable|array|max:12',
                'media_titles.*' => 'nullable|string|max:255',
                'media_orders' => 'nullable|array|max:12',
                'media_orders.*' => 'nullable|integer|min:1'
            ]);

            // Update basic galeri information
            $galeri->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'status' => $request->status
            ]);

            Log::info('Galeri basic info updated', ['id' => $galeri->id, 'judul' => $request->judul]);

            // Process new media uploads if any
            $mediaFiles = $request->file('media_files', []);
            $mediaTitles = $request->input('media_titles', []);
            $mediaOrders = $request->input('media_orders', []);

            if (!empty($mediaFiles)) {
                // Get current media count to determine starting order
                $currentMediaCount = $galeri->items()->count();
                $startingOrder = $currentMediaCount + 1;

                Log::info('Processing new photo uploads', [
                    'current_count' => $currentMediaCount,
                    'new_uploads' => count($mediaFiles),
                    'starting_order' => $startingOrder
                ]);

                foreach ($mediaFiles as $index => $file) {
                    if (!$file || !$file->isValid()) {
                        continue;
                    }

                    $title = $mediaTitles[$index] ?? "Foto " . ($index + 1);
                    $order = $mediaOrders[$index] ?? ($startingOrder + $index);

                    Log::info('Processing photo file', [
                        'index' => $index,
                        'filename' => $file->getClientOriginalName(),
                        'title' => $title,
                        'order' => $order
                    ]);

                    // Upload and process file
                    $filePath = $this->processAndStoreFile($file, $galeri->kategori, 'foto');

                    // Create galeri item
                    $galeriItem = \App\Models\GaleriItem::create([
                        'galeri_id' => $galeri->id,
                        'judul' => $title,
                        'deskripsi' => '',
                        'jenis' => 'foto',
                        'file_path' => $filePath,
                        'thumbnail' => null,
                        'urutan' => $order,
                        'status' => 'active'
                    ]);

                    Log::info('Galeri item created', [
                        'item_id' => $galeriItem->id,
                        'file_path' => $filePath
                    ]);
                }
            }

            Log::info('Galeri updated successfully', ['id' => $galeri->id, 'judul' => $request->judul]);

            return redirect()->route('admin.galeri.index')
                            ->with('success', 'Galeri berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in galeri update', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Error updating galeri', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui galeri: ' . $e->getMessage());
        }
    }

    public function destroy(Galeri $galeri)
    {
        try {
            // Delete all related galeri items first
            $galeri->items()->delete();
            
            // Delete the galeri
            $galeri->delete();
            
            Log::info('Galeri deleted successfully', ['id' => $galeri->id]);

            return redirect()->route('admin.galeri.index')
                            ->with('success', 'Galeri berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting galeri', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus galeri: ' . $e->getMessage());
        }
    }

    public function test()
    {
        try {
            Log::info('Galeri test method accessed', [
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'user_roles' => auth()->user()->roles->pluck('name'),
                'timestamp' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Galeri test method working',
                'user' => [
                    'id' => auth()->id(),
                    'name' => auth()->user()->name,
                    'roles' => auth()->user()->roles->pluck('name')
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in galeri test method', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function testForm(Request $request)
    {
        try {
            Log::info('Galeri test form method accessed', [
                'method' => $request->method(),
                'request_data' => $request->all(),
                'files' => $request->hasFile('media_files') ? count($request->file('media_files')) : 0,
                'media_titles' => $request->input('media_titles', []),
                'media_orders' => $request->input('media_orders', []),
                'media_types' => $request->input('media_types', [])
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Form data received successfully',
                'data' => [
                    'method' => $request->method(),
                    'files_count' => $request->hasFile('media_files') ? count($request->file('media_files')) : 0,
                    'media_titles' => $request->input('media_titles', []),
                    'media_orders' => $request->input('media_orders', []),
                    'media_types' => $request->input('media_types', []),
                    'all_data' => $request->all()
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in galeri test form method', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
