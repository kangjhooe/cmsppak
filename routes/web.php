<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BukuTamuController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\AgendaController;
use App\Http\Controllers\Frontend\GaleriController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\LegalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Frontend Routes (Public)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Comment routes
Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{beritaId}', [App\Http\Controllers\CommentController::class, 'getComments'])->name('comments.get');
Route::get('/agenda', [HomeController::class, 'agenda'])->name('agenda');
Route::get('/agenda/{id}', [AgendaController::class, 'show'])->name('agenda.show');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{id}', [GaleriController::class, 'show'])->name('galeri.show');
Route::get('/downloads', [App\Http\Controllers\Frontend\DownloadController::class, 'index'])->name('downloads');
Route::get('/downloads/{download}', [App\Http\Controllers\Frontend\DownloadController::class, 'show'])->name('downloads.show');
Route::get('/downloads/{download}/download', [App\Http\Controllers\Frontend\DownloadController::class, 'download'])->name('downloads.download');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [HomeController::class, 'kirimPesan'])->name('kontak.kirim');

// Legal / kebijakan publik
Route::get('/kebijakan-privasi', [LegalController::class, 'privacy'])->name('privacy');
Route::get('/syarat-layanan', [LegalController::class, 'terms'])->name('terms');
Route::get('/kebijakan-cookie', [LegalController::class, 'cookies'])->name('cookies');

// Dynamic PWA manifest dari data profil sekolah
Route::get('/site.webmanifest', function () {
    $profile = \App\Models\Profile::first();
    $name = data_get($profile, 'nama_sekolah', config('app.name', 'CMS Sekolah'));
    $shortName = \Illuminate\Support\Str::limit($name, 12, '');
    $base = rtrim(request()->getBasePath(), '/') ?: '';

    return response()->json([
        'name' => $name,
        'short_name' => $shortName,
        'description' => 'Content Management System ' . $name,
        'start_url' => $base . '/',
        'display' => 'standalone',
        'background_color' => '#ffffff',
        'theme_color' => '#008000',
        'icons' => [
            ['src' => $base . '/favicon-16x16.png', 'sizes' => '16x16', 'type' => 'image/png'],
            ['src' => $base . '/favicon-32x32.png', 'sizes' => '32x32', 'type' => 'image/png'],
            ['src' => $base . '/favicon-48x48.png', 'sizes' => '48x48', 'type' => 'image/png'],
            ['src' => $base . '/favicon-64x64.png', 'sizes' => '64x64', 'type' => 'image/png'],
            ['src' => $base . '/favicon-128x128.png', 'sizes' => '128x128', 'type' => 'image/png'],
            ['src' => $base . '/favicon-256x256.png', 'sizes' => '256x256', 'type' => 'image/png'],
        ],
    ], 200, [
        'Content-Type' => 'application/manifest+json',
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->name('webmanifest');

// Frontend Controller Routes (Alternative)
Route::prefix('frontend')->name('frontend.')->group(function () {
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/agenda/{id}', [AgendaController::class, 'show'])->name('agenda.show');
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/{id}', [GaleriController::class, 'show'])->name('galeri.show');
});

// Buku Tamu (Public)
Route::post('/buku-tamu', [BukuTamuController::class, 'store'])->name('buku-tamu.store');

// Admin Routes (Protected)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('admin')->name('admin.')->middleware(['role:admin|operator|editor'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Dev/test routes — hanya di local/debug
        if (app()->environment('local') || config('app.debug')) {
            Route::get('/sidebar-preview', function () {
                return view('admin.sidebar-preview');
            })->name('sidebar-preview');

            Route::get('/sidebar-demo', function () {
                return view('admin.sidebar-demo');
            })->name('sidebar-demo');

            Route::get('/alpine-test', function () {
                return view('admin.alpine-test');
            })->name('alpine-test');

            Route::get('/test-sidebar', function () {
                return view('admin.test-sidebar');
            })->name('test-sidebar');

            Route::get('/galeri-test', function () {
                return view('admin.galeri.test');
            })->name('galeri.test');

            Route::get('/galeri-simple', function () {
                return view('admin.galeri.index-simple');
            })->name('galeri.simple');

            Route::get('/galeri/test-method', [App\Http\Controllers\Admin\GaleriController::class, 'test'])->name('galeri.test-method');
            Route::post('/galeri/test-form', [App\Http\Controllers\Admin\GaleriController::class, 'testForm'])->name('galeri.test-form');

            Route::get('/galeri-test-index', [App\Http\Controllers\Admin\GaleriTestController::class, 'index'])->name('galeri.test-index');
            Route::get('/galeri-test-create', [App\Http\Controllers\Admin\GaleriTestController::class, 'create'])->name('galeri.test-create');
            Route::get('/galeri-test-edit/{id}', [App\Http\Controllers\Admin\GaleriTestController::class, 'edit'])->name('galeri.test-edit');
        }
        
        // Profile Management
        Route::get('/profil', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profil', [App\Http\Controllers\Admin\ProfileController::class, 'store'])->name('profile.store');
        
        // Berita Management
        Route::resource('berita', App\Http\Controllers\Admin\BeritaController::class)->parameters(['berita' => 'berita']);
        
        // Kategori Management
        Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
        Route::post('/kategori/store-ajax', [App\Http\Controllers\Admin\KategoriController::class, 'storeAjax'])->name('kategori.store-ajax');
        
        // Agenda Management
        Route::resource('agenda', App\Http\Controllers\Admin\AgendaController::class);
        
        // Galeri Management
        Route::resource('galeri', App\Http\Controllers\Admin\GaleriController::class);
        Route::get('/galeri/create', [App\Http\Controllers\Admin\GaleriController::class, 'create'])->name('galeri.create');
        
        // Galeri Items Management
        Route::prefix('galeri/{galeri}/items')->name('galeri.items.')->group(function () {
            Route::get('/create', [App\Http\Controllers\Admin\GaleriItemController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\GaleriItemController::class, 'store'])->name('store');
            Route::get('/{galeriItem}/edit', [App\Http\Controllers\Admin\GaleriItemController::class, 'edit'])->name('edit');
            Route::put('/{galeriItem}', [App\Http\Controllers\Admin\GaleriItemController::class, 'update'])->name('update');
            Route::delete('/{galeriItem}', [App\Http\Controllers\Admin\GaleriItemController::class, 'destroy'])->name('destroy');
        });
        
        // Download Management
        Route::resource('downloads', App\Http\Controllers\Admin\DownloadController::class);
        Route::patch('/downloads/{download}/toggle-status', [App\Http\Controllers\Admin\DownloadController::class, 'toggleStatus'])->name('downloads.toggle-status');
        
        // Buku Tamu Management
        Route::resource('buku-tamu', App\Http\Controllers\Admin\BukuTamuController::class);
        Route::post('/buku-tamu/{bukuTamu}/reply', [App\Http\Controllers\Admin\BukuTamuController::class, 'reply'])->name('buku-tamu.reply');
        Route::patch('/buku-tamu/{bukuTamu}/mark-as-read', [App\Http\Controllers\Admin\BukuTamuController::class, 'markAsRead'])->name('buku-tamu.mark-as-read');
        Route::patch('/buku-tamu/{bukuTamu}/mark-as-replied', [App\Http\Controllers\Admin\BukuTamuController::class, 'markAsReplied'])->name('buku-tamu.mark-as-replied');
        
        // Program Unggulan Management
        Route::resource('program-unggulan', App\Http\Controllers\Admin\ProgramUnggulanController::class);
        
        // Features Management
        Route::resource('features', App\Http\Controllers\Admin\FeatureController::class);

        // Homepage Hero Slider & Widgets
        Route::resource('hero-slides', App\Http\Controllers\Admin\HeroSlideController::class);
        Route::get('homepage-widgets-kota-search', [App\Http\Controllers\Admin\HomepageWidgetController::class, 'searchKota'])
            ->name('homepage-widgets.kota-search');
        Route::resource('homepage-widgets', App\Http\Controllers\Admin\HomepageWidgetController::class);
        
        // Comments Management
        Route::resource('comments', App\Http\Controllers\Admin\CommentController::class);
        Route::post('/comments/bulk-action', [App\Http\Controllers\Admin\CommentController::class, 'bulkAction'])->name('comments.bulk-action');
        
        // File Upload Management
        Route::post('/upload/berita-image', [App\Http\Controllers\Admin\FileUploadController::class, 'uploadBeritaImage'])->name('upload.berita-image');
        Route::post('/upload/galeri-file', [App\Http\Controllers\Admin\FileUploadController::class, 'uploadGaleriFile'])->name('upload.galeri-file');
        Route::post('/upload/download-file', [App\Http\Controllers\Admin\FileUploadController::class, 'uploadDownloadFile'])->name('upload.download-file');
        Route::delete('/upload/delete-file', [App\Http\Controllers\Admin\FileUploadController::class, 'deleteFile'])->name('upload.delete-file');
        Route::post('/upload/generate-thumbnail', [App\Http\Controllers\Admin\FileUploadController::class, 'generateThumbnail'])->name('upload.generate-thumbnail');
        
        // User & Role Management (Admin only)
        Route::middleware(['role:admin'])->group(function () {
            Route::resource('users', App\Http\Controllers\Admin\UserController::class);
            Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
        });
    });
});

// User Profile Settings
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Profile Settings - Route untuk profil user
    Route::get('/user/profile', [App\Http\Controllers\UserProfileController::class, 'show'])->name('user.profile.show');
    Route::get('/user/profile/change-password', [App\Http\Controllers\UserProfileController::class, 'showChangePassword'])->name('user.profile.change-password');
    Route::post('/user/profile/change-password', [App\Http\Controllers\UserProfileController::class, 'updatePassword'])->name('user.profile.update-password');
    
    // Redirect dari /profile ke /user/profile untuk kompatibilitas
    Route::get('/profile', function () {
        return redirect()->route('user.profile.show');
    })->name('profile.show');
});

// API Routes (if needed)
Route::prefix('api')->name('api.')->group(function () {
    // Public API endpoints
    Route::get('/berita', [BeritaController::class, 'apiIndex'])->name('berita.index');
    Route::get('/agenda', [AgendaController::class, 'apiIndex'])->name('agenda.index');
    Route::get('/galeri', [GaleriController::class, 'apiIndex'])->name('galeri.index');
});

// Dynamic slug route - catch all for custom pages
Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '[a-zA-Z0-9\-_]+');

// Fallback route for 404
Route::fallback(function () {
    $profile = \App\Models\Profile::first();
    return view('errors.404', compact('profile'));
});


