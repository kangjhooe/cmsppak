@extends('layouts.admin-simple')

@section('title', 'Alpine.js Test')

@section('content')
<div class="p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">🧪 Alpine.js Test Page</h1>
        
        <!-- Test Alpine.js Basic Functionality -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6" x-data="{ count: 0, message: 'Hello Alpine.js!' }">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Basic Alpine.js Test</h2>
            
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Counter:</span>
                    <span class="text-2xl font-bold text-blue-600" x-text="count"></span>
                    <button @click="count++" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                        Increment
                    </button>
                    <button @click="count--" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                        Decrement
                    </button>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Message:</span>
                    <input type="text" x-model="message" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <span class="text-gray-800" x-text="message"></span>
                </div>
            </div>
        </div>
        
        <!-- Test Sidebar Functionality -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6" x-data="{ sidebarTest: false }">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Sidebar Functionality Test</h2>
            
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Sidebar State:</span>
                    <span class="text-lg font-semibold" :class="sidebarTest ? 'text-green-600' : 'text-red-600'" x-text="sidebarTest ? 'OPEN' : 'CLOSED'"></span>
                    <button @click="sidebarTest = !sidebarTest" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                        Toggle Sidebar
                    </button>
                </div>
                
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Status: <span x-text="sidebarTest ? 'Sidebar terbuka' : 'Sidebar tertutup'"></span></p>
                </div>
            </div>
        </div>
        
        <!-- Test Menu Toggle -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6" x-data="{ activeMenu: '' }">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Menu Toggle Test</h2>
            
            <div class="space-y-4">
                <div class="flex space-x-2">
                    <button @click="activeMenu = activeMenu === 'menu1' ? '' : 'menu1'" 
                            class="px-4 py-2 rounded-lg transition-colors"
                            :class="activeMenu === 'menu1' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'">
                        Menu 1
                    </button>
                    <button @click="activeMenu = activeMenu === 'menu2' ? '' : 'menu2'" 
                            class="px-4 py-2 rounded-lg transition-colors"
                            :class="activeMenu === 'menu2' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'">
                        Menu 2
                    </button>
                    <button @click="activeMenu = activeMenu === 'menu3' ? '' : 'menu3'" 
                            class="px-4 py-2 rounded-lg transition-colors"
                            :class="activeMenu === 'menu3' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'">
                        Menu 3
                    </button>
                </div>
                
                <div x-show="activeMenu === 'menu1'" x-transition class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-500">
                    <p class="text-blue-800">Menu 1 content - Alpine.js berfungsi! 🎉</p>
                </div>
                
                <div x-show="activeMenu === 'menu2'" x-transition class="bg-green-50 p-4 rounded-lg border-l-4 border-green-500">
                    <p class="text-green-800">Menu 2 content - Alpine.js berfungsi! 🎉</p>
                </div>
                
                <div x-show="activeMenu === 'menu3'" x-transition class="bg-purple-50 p-4 rounded-lg border-l-4 border-purple-500">
                    <p class="text-purple-800">Menu 3 content - Alpine.js berfungsi! 🎉</p>
                </div>
            </div>
        </div>
        
        <!-- Test Responsive Behavior -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Responsive Test</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-2">Screen Size</h3>
                    <p class="text-sm text-gray-600">Width: <span x-text="window.innerWidth"></span>px</p>
                    <p class="text-sm text-gray-600">Height: <span x-text="window.innerHeight"></span>px</p>
                </div>
                
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-2">Device Type</h3>
                    <p class="text-sm text-gray-600">Mobile: <span x-text="window.innerWidth < 768 ? 'Yes' : 'No'"></span></p>
                    <p class="text-sm text-gray-600">Tablet: <span x-text="window.innerWidth >= 768 && window.innerWidth < 1024 ? 'Yes' : 'No'"></span></p>
                    <p class="text-sm text-gray-600">Desktop: <span x-text="window.innerWidth >= 1024 ? 'Yes' : 'No'"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
