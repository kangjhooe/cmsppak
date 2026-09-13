<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- Header Profil User -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-8 text-white">
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                        <p class="text-blue-100">{{ $user->email }}</p>
                        <p class="text-blue-100">{{ ucfirst($user->role ?? 'User') }}</p>
                        <p class="text-blue-100">Bergabung sejak: {{ $user->created_at->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi User -->
            <div class="px-6 py-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Profil</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Dasar -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dasar</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="font-medium text-gray-700">Nama Lengkap:</span>
                                <p class="text-gray-900">{{ $user->name }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Email:</span>
                                <p class="text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Role:</span>
                                <p class="text-gray-900">{{ ucfirst($user->role ?? 'User') }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Status:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Aktivitas -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik Aktivitas</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-600">{{ $user->created_at->diffInDays(now()) }}</div>
                                <div class="text-sm text-gray-600">Hari Bergabung</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-600">{{ $user->updated_at->diffInDays(now()) }}</div>
                                <div class="text-sm text-gray-600">Hari Terakhir Update</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-purple-600">{{ $user->id }}</div>
                                <div class="text-sm text-gray-600">ID User</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-orange-600">{{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}</div>
                                <div class="text-sm text-gray-600">Status Email</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Aktivitas -->
                <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Aktivitas</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                            <span class="text-gray-700">Akun dibuat pada {{ $user->created_at->format('d-m-Y H:i') }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                            <span class="text-gray-700">Terakhir login pada {{ $user->updated_at->format('d-m-Y H:i') }}</span>
                        </div>
                        @if($user->email_verified_at)
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-purple-400 rounded-full"></div>
                            <span class="text-gray-700">Email diverifikasi pada {{ $user->email_verified_at->format('d-m-Y H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Hak Akses -->
                <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Hak Akses</h3>
                    <div class="flex flex-wrap gap-2">
                        @if($user->role === 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                Administrator
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Kelola Semua Data
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Kelola User
                            </span>
                        @elseif($user->role === 'operator')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Operator
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Kelola Konten
                            </span>
                        @elseif($user->role === 'editor')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Editor
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                Edit Konten
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                User
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Lihat Konten
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Informasi Keamanan -->
                <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Keamanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <span class="font-medium text-gray-700">Password:</span>
                            <p class="text-gray-900 mt-1">•••••••• (Terenkripsi)</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Two-Factor Auth:</span>
                            <p class="text-gray-900 mt-1">Tidak Aktif</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Session Aktif:</span>
                            <p class="text-gray-900 mt-1">Ya</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">IP Address:</span>
                            <p class="text-gray-900 mt-1">{{ request()->ip() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
