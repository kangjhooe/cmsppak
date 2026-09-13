@extends('layouts.admin-simple')

@section('title', 'Test Sidebar - Admin Panel')

@section('content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Test Sidebar</h1>
        <p class="text-gray-600 mb-4">Halaman ini untuk testing apakah sidebar muncul dengan benar.</p>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-blue-900 mb-2">Status Sidebar:</h2>
            <ul class="text-blue-800 space-y-1">
                <li>✅ Layout: admin-simple</li>
                <li>✅ Route: {{ request()->route()->getName() }}</li>
                <li>✅ URL: {{ request()->url() }}</li>
                <li>✅ Method: {{ request()->method() }}</li>
            </ul>
        </div>
        
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mt-4">
            <h2 class="text-lg font-semibold text-green-900 mb-2">Route Detection Test:</h2>
            <ul class="text-green-800 space-y-1">
                <li>admin.dashboard: {{ request()->routeIs('admin.dashboard') ? '✅ TRUE' : '❌ FALSE' }}</li>
                <li>admin.guru-staf*: {{ request()->routeIs('admin.guru-staf*') ? '✅ TRUE' : '❌ FALSE' }}</li>
                <li>admin.guru-staf.create: {{ request()->routeIs('admin.guru-staf.create') ? '✅ TRUE' : '❌ FALSE' }}</li>
                <li>admin.berita*: {{ request()->routeIs('admin.berita*') ? '✅ TRUE' : '❌ FALSE' }}</li>
                <li>admin.agenda*: {{ request()->routeIs('admin.agenda*') ? '✅ TRUE' : '❌ FALSE' }}</li>
            </ul>
        </div>
        
        <div class="mt-6 space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Dashboard
            </a>
            
            <a href="{{ route('admin.guru-staf.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors ml-3">
                <i class="fas fa-users mr-2"></i>
                Test Guru Staf Create
            </a>
        </div>
    </div>
</div>
@endsection
