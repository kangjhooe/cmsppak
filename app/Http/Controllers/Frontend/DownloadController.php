<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $query = Download::active();
        
        if ($request->has('kategori') && $request->kategori != '') {
            $query->byCategory($request->kategori);
        }
        
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }
        
        $downloads = $query->orderBy('created_at', 'desc')->paginate(12);
        $kategoris = Download::active()->distinct()->pluck('kategori');
        
        return view('frontend.downloads.index', compact('downloads', 'kategoris'));
    }

    public function download(Download $download)
    {
        if (!$download->is_active) {
            abort(404);
        }
        
        $download->incrementDownload();
        
        if (Storage::disk('public')->exists($download->path_file)) {
            return Storage::disk('public')->download($download->path_file, $download->nama_file);
        }
        
        abort(404);
    }

    public function show(Download $download)
    {
        if (!$download->is_active) {
            abort(404);
        }
        
        return view('frontend.downloads.show', compact('download'));
    }
}
