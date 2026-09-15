<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Berita;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['berita', 'user'])->latest();
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('komentar', 'like', "%{$search}%")
                  ->orWhereHas('berita', function($beritaQuery) use ($search) {
                      $beritaQuery->where('judul', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filter by date
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        $comments = $query->paginate(15)->withQueryString();
        
        // Statistik komentar
        $stats = [
            'total' => Comment::count(),
            'pending' => Comment::where('status', 'pending')->count(),
            'approved' => Comment::where('status', 'approved')->count(),
            'rejected' => Comment::where('status', 'rejected')->count(),
        ];
        
        return view('admin.comments.index', compact('comments', 'stats'));
    }

    public function show(Comment $comment)
    {
        $comment->load(['berita', 'user', 'replies']);
        return view('admin.comments.show', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $comment->update([
            'status' => $request->status
        ]);

        $statusText = [
            'pending' => 'menunggu persetujuan',
            'approved' => 'disetujui',
            'rejected' => 'ditolak'
        ];

        return redirect()->route('admin.comments.index')
                        ->with('success', "Komentar berhasil {$statusText[$request->status]}");
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        
        return redirect()->route('admin.comments.index')
                        ->with('success', 'Komentar berhasil dihapus');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,delete',
            'comment_ids' => 'required|array|min:1',
            'comment_ids.*' => 'exists:comments,id'
        ]);

        $commentIds = $request->comment_ids;
        
        $count = count($commentIds);
        
        switch ($request->action) {
            case 'approve':
                Comment::whereIn('id', $commentIds)->update(['status' => 'approved']);
                $message = "{$count} komentar berhasil disetujui";
                break;
                
            case 'reject':
                Comment::whereIn('id', $commentIds)->update(['status' => 'rejected']);
                $message = "{$count} komentar berhasil ditolak";
                break;
                
            case 'delete':
                Comment::whereIn('id', $commentIds)->delete();
                $message = "{$count} komentar berhasil dihapus";
                break;
        }

        return redirect()->route('admin.comments.index')
                        ->with('success', $message);
    }
}