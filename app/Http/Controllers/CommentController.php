<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'berita_id' => 'required|exists:berita,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'komentar' => 'required|string|min:10|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ], [
            'berita_id.required' => 'ID berita diperlukan',
            'berita_id.exists' => 'Berita tidak ditemukan',
            'nama.required' => 'Nama diperlukan',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email diperlukan',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'komentar.required' => 'Komentar diperlukan',
            'komentar.min' => 'Komentar minimal 10 karakter',
            'komentar.max' => 'Komentar maksimal 1000 karakter',
            'parent_id.exists' => 'Komentar yang di-reply tidak ditemukan'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cek apakah berita ada dan published
        $berita = Berita::where('id', $request->berita_id)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->first();

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan atau belum dipublikasikan'
            ], 404);
        }

        // Jika ada parent_id, cek apakah parent comment ada dan approved
        if ($request->parent_id) {
            $parentComment = Comment::where('id', $request->parent_id)
                ->where('berita_id', $request->berita_id)
                ->where('status', 'approved')
                ->first();

            if (!$parentComment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Komentar yang di-reply tidak ditemukan'
                ], 404);
            }
        }

        try {
            $comment = Comment::create([
                'berita_id' => $request->berita_id,
                'user_id' => auth()->id(), // null jika guest
                'nama' => $request->nama,
                'email' => $request->email,
                'komentar' => $request->komentar,
                'parent_id' => $request->parent_id,
                'status' => 'pending' // Default pending, admin bisa approve
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Komentar berhasil dikirim dan sedang menunggu persetujuan',
                'data' => [
                    'id' => $comment->id,
                    'nama' => $comment->nama,
                    'komentar' => $comment->komentar,
                    'formatted_date' => $comment->formatted_date,
                    'initials' => $comment->initials
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan komentar'
            ], 500);
        }
    }

    public function getComments($beritaId)
    {
        $berita = Berita::where('id', $beritaId)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->first();

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan'
            ], 404);
        }

        $comments = $berita->comments()->get();

        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }
}
