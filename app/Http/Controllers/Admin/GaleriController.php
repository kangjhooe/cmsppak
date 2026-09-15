<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\GaleriItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Galeri::with(['activeItems'])
                ->withCount('activeItems')
                ->latest();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%");
                });
            }

            if ($request->filled('kategori')) {
                $query->where('kategori', $request->kategori);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $galeri = $query->paginate(10)->withQueryString();

            $stats = [
                'total' => Galeri::count(),
                'active' => Galeri::where('status', 'active')->count(),
                'kategori' => Galeri::query()
                    ->whereNotNull('kategori')
                    ->where('kategori', '!=', '')
                    ->distinct()
                    ->count('kategori'),
                'media' => GaleriItem::where('status', 'active')->count(),
            ];

            Log::info('Galeri index accessed successfully', ['count' => $galeri->count()]);
            return view('admin.galeri.index', compact('galeri', 'stats'));
        } catch (\Exception $e) {
            Log::error('Error accessing galeri index', ['error' => $e->getMessage()]);
            $galeri = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
            $stats = ['total' => 0, 'active' => 0, 'kategori' => 0, 'media' => 0];
            return view('admin.galeri.index', compact('galeri', 'stats'));
        }
    }

    public function create()
    {
        try {
            Log::info('Galeri create form accessed', [
                'user_id' => auth()->id(),
                'timestamp' => now()
            ]);
            return view('admin.galeri.create');
        } catch (\Exception $e) {
            Log::error('Error accessing galeri create form', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat membuka form tambah galeri');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'kategori' => 'nullable|string|max:100',
                'status' => 'required|in:active,inactive',
                'media_types' => 'nullable|array|max:12',
                'media_types.*' => 'nullable|in:file,youtube',
                'media_files' => 'nullable|array|max:12',
                'media_files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'youtube_urls' => 'nullable|array|max:12',
                'youtube_urls.*' => 'nullable|string|max:500',
                'media_titles' => 'nullable|array|max:12',
                'media_titles.*' => 'nullable|string|max:255',
                'media_orders' => 'nullable|array|max:12',
                'media_orders.*' => 'nullable|integer|min:1'
            ]);

            $slots = $this->collectMediaSlots($request);

            if (count($slots) < 4) {
                return back()->withInput()->with('error', 'Minimal 4 media (foto atau YouTube) harus diisi');
            }

            if (count($slots) > 12) {
                return back()->withInput()->with('error', 'Maksimal 12 media per galeri');
            }

            $galeri = Galeri::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'status' => $request->status
            ]);

            $processedCount = $this->persistMediaSlots($galeri, $slots);

            if ($processedCount < 4) {
                $galeri->items()->delete();
                $galeri->delete();
                return back()->withInput()->with('error', 'Minimal 4 media harus berhasil disimpan');
            }

            Log::info('Galeri multi-media created successfully', [
                'galeri_id' => $galeri->id,
                'media_count' => $processedCount
            ]);

            return redirect()->route('admin.galeri.index')
                            ->with('success', 'Galeri berhasil dibuat dengan ' . $processedCount . ' media');

        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Error creating galeri multi-media', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan galeri: ' . $e->getMessage());
        }
    }

    public function edit(Galeri $galeri)
    {
        try {
            $galeri->load('items');
            return view('admin.galeri.edit', compact('galeri'));
        } catch (\Exception $e) {
            Log::error('Error accessing galeri edit form', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat membuka form edit galeri');
        }
    }

    public function update(Request $request, Galeri $galeri)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'kategori' => 'nullable|string|max:100',
                'status' => 'required|in:active,inactive',
                'media_types' => 'nullable|array|max:12',
                'media_types.*' => 'nullable|in:file,youtube',
                'media_files' => 'nullable|array|max:12',
                'media_files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'youtube_urls' => 'nullable|array|max:12',
                'youtube_urls.*' => 'nullable|string|max:500',
                'media_titles' => 'nullable|array|max:12',
                'media_titles.*' => 'nullable|string|max:255',
                'media_orders' => 'nullable|array|max:12',
                'media_orders.*' => 'nullable|integer|min:1'
            ]);

            $galeri->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'status' => $request->status
            ]);

            $slots = $this->collectMediaSlots($request);
            if (!empty($slots)) {
                $currentCount = $galeri->items()->count();
                if ($currentCount + count($slots) > 12) {
                    return back()->withInput()->with('error', 'Total media tidak boleh lebih dari 12');
                }
                $this->persistMediaSlots($galeri, $slots, $currentCount + 1);
            }

            return redirect()->route('admin.galeri.index')
                            ->with('success', 'Galeri berhasil diperbarui');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Error updating galeri', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui galeri: ' . $e->getMessage());
        }
    }

    public function destroy(Galeri $galeri)
    {
        try {
            foreach ($galeri->items as $item) {
                if ($item->file_path) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($item->file_path);
                }
                if ($item->thumbnail) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($item->thumbnail);
                }
            }
            $galeri->items()->delete();
            $galeri->delete();

            return redirect()->route('admin.galeri.index')
                            ->with('success', 'Galeri berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting galeri', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus galeri: ' . $e->getMessage());
        }
    }

    /**
     * Collect filled media slots from create/edit form (indexed 0-11).
     */
    private function collectMediaSlots(Request $request): array
    {
        $mediaTypes = $request->input('media_types', []);
        $mediaFiles = $request->file('media_files', []);
        $youtubeUrls = $request->input('youtube_urls', []);
        $mediaTitles = $request->input('media_titles', []);
        $mediaOrders = $request->input('media_orders', []);

        $slots = [];

        for ($i = 0; $i < 12; $i++) {
            $type = $mediaTypes[$i] ?? 'file';
            $title = trim((string) ($mediaTitles[$i] ?? ''));
            $order = (int) ($mediaOrders[$i] ?? ($i + 1));

            if ($type === 'youtube') {
                $rawUrl = trim((string) ($youtubeUrls[$i] ?? ''));
                if ($rawUrl === '') {
                    continue;
                }

                $normalized = GaleriItem::normalizeYoutubeUrl($rawUrl);
                if (!$normalized) {
                    throw ValidationException::withMessages([
                        "youtube_urls.$i" => "URL YouTube pada slot media " . ($i + 1) . " tidak valid."
                    ]);
                }

                $slots[] = [
                    'jenis' => 'youtube',
                    'judul' => $title !== '' ? $title : ('YouTube ' . ($i + 1)),
                    'youtube_url' => $normalized,
                    'file_path' => null,
                    'urutan' => $order > 0 ? $order : ($i + 1),
                ];
                continue;
            }

            $file = $mediaFiles[$i] ?? null;
            if (!$file || !$file->isValid()) {
                continue;
            }

            $slots[] = [
                'jenis' => 'foto',
                'judul' => $title !== '' ? $title : ('Foto ' . ($i + 1)),
                'youtube_url' => null,
                'file' => $file,
                'urutan' => $order > 0 ? $order : ($i + 1),
            ];
        }

        return $slots;
    }

    private function persistMediaSlots(Galeri $galeri, array $slots, int $startingOrder = 1): int
    {
        $processed = 0;

        foreach ($slots as $index => $slot) {
            $order = $slot['urutan'] ?? ($startingOrder + $index);
            $data = [
                'galeri_id' => $galeri->id,
                'judul' => $slot['judul'],
                'deskripsi' => '',
                'jenis' => $slot['jenis'],
                'youtube_url' => $slot['youtube_url'] ?? null,
                'file_path' => null,
                'thumbnail' => null,
                'urutan' => $order,
                'status' => 'active',
            ];

            if ($slot['jenis'] === 'foto' && isset($slot['file'])) {
                $data['file_path'] = $this->processAndStoreFile($slot['file'], $galeri->kategori);
            }

            GaleriItem::create($data);
            $processed++;
        }

        return $processed;
    }

    private function processAndStoreFile($file, $kategori)
    {
        $folder = 'galeri/' . ($kategori ?: 'umum');
        return $file->store($folder, 'public');
    }

    public function test()
    {
        return response()->json([
            'success' => true,
            'message' => 'Galeri test method working',
            'user' => [
                'id' => auth()->id(),
                'name' => auth()->user()->name,
            ]
        ]);
    }

    public function testForm(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Form data received successfully',
            'data' => [
                'media_types' => $request->input('media_types', []),
                'youtube_urls' => $request->input('youtube_urls', []),
                'files_count' => $request->hasFile('media_files') ? count($request->file('media_files')) : 0,
            ]
        ]);
    }
}
