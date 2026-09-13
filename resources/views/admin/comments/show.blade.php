@extends('layouts.admin-simple')

@section('title', 'Detail Komentar')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Komentar</h1>
            <p class="text-muted">Lihat detail komentar dari pengunjung</p>
        </div>
        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Detail Komentar -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Komentar</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Nama:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $comment->nama }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-sm-9">
                            <a href="mailto:{{ $comment->email }}">{{ $comment->email }}</a>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-sm-9">
                            @if($comment->status == 'pending')
                                <span class="badge badge-warning">Menunggu Persetujuan</span>
                            @elseif($comment->status == 'approved')
                                <span class="badge badge-success">Disetujui</span>
                            @else
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Tanggal:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $comment->created_at->format('d F Y, H:i') }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Komentar:</strong>
                        </div>
                        <div class="col-sm-9">
                            <div class="border p-3 rounded bg-light">
                                {{ $comment->komentar }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berita Terkait -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Berita Terkait</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Judul:</strong>
                        </div>
                        <div class="col-sm-9">
                            <a href="{{ route('berita.show', $comment->berita->slug) }}" target="_blank" class="text-decoration-none">
                                {{ $comment->berita->judul }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <strong>Status Berita:</strong>
                        </div>
                        <div class="col-sm-9">
                            @if($comment->berita->status == 'published')
                                <span class="badge badge-success">Dipublikasikan</span>
                            @else
                                <span class="badge badge-secondary">Draft</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <strong>Tanggal Publikasi:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $comment->berita->published_at ? $comment->berita->published_at->format('d F Y, H:i') : 'Belum dipublikasikan' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aksi -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    @if($comment->status == 'pending')
                        <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="mb-3">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> Setujui Komentar
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="mb-3">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-warning btn-block">
                                <i class="fas fa-times"></i> Tolak Komentar
                            </button>
                        </form>
                    @elseif($comment->status == 'approved')
                        <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="mb-3">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-warning btn-block">
                                <i class="fas fa-times"></i> Ubah ke Ditolak
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="mb-3">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> Ubah ke Disetujui
                            </button>
                        </form>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Hapus Komentar
                        </button>
                    </form>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Tambahan</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <strong>ID Komentar:</strong>
                        </div>
                        <div class="col-sm-7">
                            #{{ $comment->id }}
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <strong>IP Address:</strong>
                        </div>
                        <div class="col-sm-7">
                            {{ request()->ip() }}
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <strong>User Agent:</strong>
                        </div>
                        <div class="col-sm-7">
                            <small class="text-muted">{{ request()->userAgent() }}</small>
                        </div>
                    </div>
                    
                    @if($comment->user)
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <strong>User Login:</strong>
                        </div>
                        <div class="col-sm-7">
                            <span class="badge badge-info">{{ $comment->user->name }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
