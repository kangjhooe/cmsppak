@extends('layouts.admin')

@section('title', 'Detail Kategori')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Kategori</h3>
                    <div>
                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Nama Kategori:</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="color-box me-2" style="width: 30px; height: 30px; background-color: {{ $kategori->warna }}; border-radius: 5px;"></div>
                                            <span class="h5 mb-0">{{ $kategori->nama }}</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Slug:</strong></td>
                                    <td><code>{{ $kategori->slug }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Warna:</strong></td>
                                    <td>
                                        <span class="badge" style="background-color: {{ $kategori->warna }}; color: white; font-size: 14px;">
                                            {{ $kategori->warna }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($kategori->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Deskripsi:</strong></td>
                                    <td>{{ $kategori->deskripsi ?: 'Tidak ada deskripsi' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $kategori->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Diperbarui:</strong></td>
                                    <td>{{ $kategori->updated_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Statistik</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <h2 class="text-primary">{{ $kategori->berita->count() }}</h2>
                                        <p class="text-muted">Total Berita</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($kategori->berita->count() > 0)
                    <hr>
                    <h5>Berita dalam Kategori Ini</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategori->berita as $berita)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $berita->judul }}</td>
                                    <td>
                                        @if($berita->status === 'published')
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-warning">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $berita->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.berita.edit', $berita) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
