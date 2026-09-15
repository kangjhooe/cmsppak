<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontendApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API Routes untuk Frontend
Route::prefix('v1')->name('api.v1.')->group(function () {
    // Berita
    Route::get('/berita', [FrontendApiController::class, 'getBerita'])->name('berita.index');
    Route::get('/berita/{slug}', [FrontendApiController::class, 'getBeritaDetail'])->name('berita.show');
    
    // Agenda
    Route::get('/agenda', [FrontendApiController::class, 'getAgenda'])->name('agenda.index');
    
    // Galeri
    Route::get('/galeri', [FrontendApiController::class, 'getGaleri'])->name('galeri.index');
    
    // Profile Sekolah
    Route::get('/profile', [FrontendApiController::class, 'getProfile'])->name('profil.sekolah');
    
    // Downloads
    Route::get('/downloads', [FrontendApiController::class, 'getDownloads'])->name('downloads.index');
    Route::post('/downloads/{id}/increment', [FrontendApiController::class, 'incrementDownload'])->name('downloads.increment');
    
    // Search Global
    Route::get('/search', [FrontendApiController::class, 'search'])->name('search');
});

// Admin API Routes (Protected)
Route::middleware(['auth:sanctum'])->prefix('v1/admin')->name('api.v1.admin.')->group(function () {
    // Routes admin yang memerlukan autentikasi
});
