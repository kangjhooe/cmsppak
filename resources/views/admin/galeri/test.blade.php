@extends('layouts.admin-simple')

@section('title', 'Test Galeri - ' . ($schoolName ?? ''))

@section('content')
    <div class="space-y-6">
        <div class="card p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">Test Galeri View</h1>
            <p class="text-gray-600">Ini adalah halaman test untuk memverifikasi bahwa view galeri bisa diakses.</p>
            <div class="mt-4 p-4 bg-green-100 rounded-lg">
                <p class="text-green-800">✅ View berhasil diakses!</p>
            </div>
        </div>
    </div>
@endsection
