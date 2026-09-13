<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GaleriTestController extends Controller
{
    public function index()
    {
        // Return empty collection for testing
        $galeri = collect([]);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function edit($id)
    {
        // Create dummy data for testing
        $galeri = (object) [
            'id' => $id,
            'judul' => 'Test Item',
            'deskripsi' => 'Ini adalah item test',
            'jenis' => 'foto',
            'file_path' => null,
            'thumbnail' => null,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ];
        
        return view('admin.galeri.edit', compact('galeri'));
    }
}
