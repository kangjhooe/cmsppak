@extends('layouts.admin-simple-test')

@section('title', 'Test Simple Alpine - Admin Panel')

@section('content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Test Simple Alpine</h1>
        <p class="text-gray-600 mb-4">Halaman ini menggunakan layout admin-simple-test dengan Alpine.js sederhana.</p>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-blue-900 mb-2">Status Layout:</h2>
            <ul class="text-blue-800 space-y-1">
                <li>✅ Layout: admin-simple-test</li>
                <li>✅ Route: {{ request()->route()->getName() }}</li>
                <li>✅ URL: {{ request()->url() }}</li>
                <li>✅ Method: {{ request()->method() }}</li>
            </ul>
        </div>
        
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mt-4">
            <h2 class="text-lg font-semibold text-green-900 mb-2">Alpine.js Test:</h2>
            <div x-data="{ count: 0 }" class="text-green-800">
                <p>Counter: <span x-text="count"></span></p>
                <button @click="count++" class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Increment
                </button>
            </div>
        </div>
        
        <div class="mt-6 space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Dashboard
            </a>
            
            <a href="{{ route('admin.guru-staf.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors ml-3">
                <i class="fas fa-plus mr-2"></i>
                Test Guru Staf Create
            </a>
        </div>
    </div>
</div>
@endsection
