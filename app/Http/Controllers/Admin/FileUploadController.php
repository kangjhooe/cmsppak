<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FileUploadController extends Controller
{
    /**
     * Upload file untuk berita
     */
    public function uploadBeritaImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        try {
            $file = $request->file('image');
            $filename = 'berita_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/berita', $filename);

            return response()->json([
                'success' => true,
                'filename' => $filename,
                'path' => $path,
                'url' => asset('storage/berita/' . $filename)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload file: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload file untuk galeri (hanya foto)
     */
    public function uploadGaleriFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:10240'
        ]);

        try {
            $file = $request->file('file');
            $filename = 'galeri_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // Simpan di folder galeri/foto
            $folder = 'galeri/foto';
            $path = $file->storeAs('public/' . $folder, $filename);

            return response()->json([
                'success' => true,
                'filename' => $filename,
                'path' => $path,
                'url' => asset('storage/' . $folder . '/' . $filename),
                'type' => 'foto'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload file: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload file untuk download
     */
    public function uploadDownloadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar|max:51200'
        ]);

        try {
            $file = $request->file('file');
            $filename = 'download_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/downloads', $filename);

            return response()->json([
                'success' => true,
                'filename' => $filename,
                'path' => $path,
                'url' => asset('storage/downloads/' . $filename),
                'size' => $file->getSize(),
                'type' => $file->getClientOriginalExtension()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload file: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hapus file
     */
    public function deleteFile(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        try {
            if (Storage::exists($request->path)) {
                Storage::delete($request->path);
                return response()->json([
                    'success' => true,
                    'message' => 'File berhasil dihapus'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'File tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus file: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate thumbnail untuk gambar
     */
    public function generateThumbnail(Request $request)
    {
        $request->validate([
            'image_path' => 'required|string'
        ]);

        try {
            $imagePath = $request->image_path;
            $fullPath = storage_path('app/public/' . $imagePath);
            
            if (!file_exists($fullPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File gambar tidak ditemukan'
                ], 404);
            }

            // Buat thumbnail menggunakan Intervention Image
            $image = \Intervention\Image\Facades\Image::make($fullPath);
            $thumbnail = $image->fit(300, 200)->encode('jpg', 80);
            
            $thumbnailPath = str_replace(['.jpg', '.jpeg', '.png', '.gif', '.webp'], '_thumb.jpg', $imagePath);
            Storage::put('public/' . $thumbnailPath, $thumbnail);

            return response()->json([
                'success' => true,
                'thumbnail_path' => $thumbnailPath,
                'thumbnail_url' => asset('storage/' . $thumbnailPath)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat thumbnail: ' . $e->getMessage()
            ], 500);
        }
    }
}
