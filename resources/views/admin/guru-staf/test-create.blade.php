@extends('layouts.admin-test')

@section('title', 'Test Create Layout - Admin Panel')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">Test Create Layout</h1>
                <p class="text-gray-600 mb-4">Halaman ini menggunakan layout admin-test untuk testing.</p>
                
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h2 class="text-lg font-semibold text-blue-900 mb-2">Status Layout:</h2>
                    <ul class="text-blue-800 space-y-1">
                        <li>✅ Layout: admin-test</li>
                        <li>✅ Route: {{ request()->route()->getName() }}</li>
                        <li>✅ URL: {{ request()->url() }}</li>
                        <li>✅ Method: {{ request()->method() }}</li>
                    </ul>
                </div>
                
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <h2 class="text-lg font-semibold text-green-900 mb-2">Route Detection Test:</h2>
                    <ul class="text-green-800 space-y-1">
                        <li>admin.guru-staf*: {{ request()->routeIs('admin.guru-staf*') ? '✅ TRUE' : '❌ FALSE' }}</li>
                        <li>admin.guru-staf.create: {{ request()->routeIs('admin.guru-staf.create') ? '✅ TRUE' : '❌ FALSE' }}</li>
                        <li>admin.guru-staf.index: {{ request()->routeIs('admin.guru-staf.index') ? '✅ TRUE' : '❌ FALSE' }}</li>
                    </ul>
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
    </div>
</div>
@endsection
