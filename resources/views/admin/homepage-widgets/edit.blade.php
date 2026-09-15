@extends('layouts.admin-simple')

@section('title', 'Edit Widget - ' . $schoolName)

@section('content')
<div class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Widget Beranda</h1>
            <form action="{{ route('admin.homepage-widgets.update', $widget) }}" method="POST" class="space-y-6"
                  x-data="{ tipe: '{{ old('tipe', $widget->tipe) }}', lokasiMode: '{{ old('lokasi_mode', $widget->config['lokasi_mode'] ?? 'gps') }}' }">
                @csrf
                @method('PUT')
                @include('admin.homepage-widgets._form', ['widget' => $widget])
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('admin.homepage-widgets.index') }}" class="px-5 py-2.5 border rounded-lg text-gray-700 hover:bg-gray-50">Kembali</a>
                    <button type="submit" class="px-5 py-2.5 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
