<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    public function index(Request $request)
    {
        $query = BukuTamu::query();
        
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
                  ->orWhere('pesan', 'like', "%{$search}%")
                  ->orWhere('instansi', 'like', "%{$search}%");
            });
        }
        
        // Filter by date
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        $bukuTamu = $query->latest()->paginate(15);
        return view('admin.buku-tamu.index', compact('bukuTamu'));
    }

    public function show(BukuTamu $bukuTamu)
    {
        // Mark as read if unread
        if ($bukuTamu->status === 'unread') {
            $bukuTamu->update(['status' => 'read']);
        }
        
        return view('admin.buku-tamu.show', compact('bukuTamu'));
    }

    public function reply(Request $request, BukuTamu $bukuTamu)
    {
        $request->validate([
            'balasan' => 'required|string|max:1000'
        ]);

        $bukuTamu->update([
            'balasan' => $request->balasan,
            'status' => 'replied',
            'replied_at' => now()
        ]);

        return redirect()->route('admin.buku-tamu.index')
                        ->with('success', 'Balasan berhasil dikirim');
    }

    public function destroy(BukuTamu $bukuTamu)
    {
        $bukuTamu->delete();

        return redirect()->route('admin.buku-tamu.index')
                        ->with('success', 'Pesan buku tamu berhasil dihapus');
    }

    public function markAsRead(BukuTamu $bukuTamu)
    {
        $bukuTamu->update(['status' => 'read']);
        
        return redirect()->back()->with('success', 'Status berhasil diubah menjadi telah dibaca');
    }

    public function markAsReplied(BukuTamu $bukuTamu)
    {
        $bukuTamu->update(['status' => 'replied']);
        
        return redirect()->back()->with('success', 'Status berhasil diubah menjadi telah dibalas');
    }
}
