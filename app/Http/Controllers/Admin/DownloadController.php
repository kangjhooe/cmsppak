<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $query = Download::query()->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('nama_file', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($request->filled('tipe')) {
            $query->where('tipe_file', $request->tipe);
        }

        $downloads = $query->paginate(10)->withQueryString();

        $stats = [
            'total' => Download::count(),
            'active' => Download::where('is_active', true)->count(),
            'inactive' => Download::where('is_active', false)->count(),
            'pdf' => Download::where('tipe_file', 'pdf')->count(),
        ];

        return view('admin.downloads.index', compact('downloads', 'stats'));
    }

    public function create()
    {
        return view('admin.downloads.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar|max:51200'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('downloads', $fileName, 'public');

        Download::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'nama_file' => $file->getClientOriginalName(),
            'path_file' => $filePath,
            'tipe_file' => $file->getClientOriginalExtension(),
            'ukuran_file' => $file->getSize(),
            'kategori' => $request->kategori,
            'is_active' => true
        ]);

        return redirect()->route('admin.downloads.index')->with('success', 'File berhasil ditambahkan');
    }

    public function edit(Download $download)
    {
        return view('admin.downloads.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar|max:51200'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'is_active' => $request->has('is_active')
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama
            if (Storage::disk('public')->exists($download->path_file)) {
                Storage::disk('public')->delete($download->path_file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('downloads', $fileName, 'public');

            $data['nama_file'] = $file->getClientOriginalName();
            $data['path_file'] = $filePath;
            $data['tipe_file'] = $file->getClientOriginalExtension();
            $data['ukuran_file'] = $file->getSize();
        }

        $download->update($data);

        return redirect()->route('admin.downloads.index')->with('success', 'File berhasil diperbarui');
    }

    public function destroy(Download $download)
    {
        if (Storage::disk('public')->exists($download->path_file)) {
            Storage::disk('public')->delete($download->path_file);
        }

        $download->delete();

        return redirect()->route('admin.downloads.index')->with('success', 'File berhasil dihapus');
    }

    public function toggleStatus(Download $download)
    {
        $download->update(['is_active' => !$download->is_active]);
        
        $status = $download->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "File berhasil {$status}");
    }
}
