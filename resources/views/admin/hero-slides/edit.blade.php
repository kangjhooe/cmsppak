@extends('layouts.admin-simple')

@section('title', 'Edit Slide Hero - ' . $schoolName)

@section('content')
<div class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Slide Hero</h1>

            <form action="{{ route('admin.hero-slides.update', $slide) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                @include('admin.hero-slides._form', ['slide' => $slide])

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('admin.hero-slides.index') }}" class="px-5 py-2.5 border rounded-lg text-gray-700 hover:bg-gray-50">Kembali</a>
                    <button type="submit" class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
