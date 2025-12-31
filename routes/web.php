<?php

use Illuminate\Support\Facades\Route;

// ===== Front Controllers =====
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\NewsController;
use App\Http\Controllers\Front\GalleryController;
use App\Http\Controllers\Front\ContactController;

// ===== Auth & Admin Controllers =====
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\SarprasController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\StaffController;
/*
|--------------------------------------------------------------------------
| ROUTES — FRONT
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil
Route::prefix('profil')->name('profile.')->group(function () {
    Route::view('identitas', 'profile.identitas')->name('identitas');
    Route::get('guru-tendik', [ProfileController::class, 'guruTendik'])->name('guru');
    Route::view('sejarah', 'profile.sejarah')->name('sejarah');
    Route::get('sarpras', [ProfileController::class, 'sarpras'])->name('sarpras');
    Route::get('sarpras/{slug}', [ProfileController::class, 'showSarpras'])->name('sarpras.show');
});

// Berita
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// Galeri
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');

// Hubungi Kami
Route::get('/hubungi-kami', [ContactController::class, 'index'])->name('hubungi.index');
Route::post('/hubungi-kami', [ContactController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('hubungi.store');


/*
|--------------------------------------------------------------------------
| ROUTES — AUTH (Login Admin Manual)
|--------------------------------------------------------------------------
*/
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:10,1')
    ->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTES — ADMIN (protected by 'admin' middleware)
|--------------------------------------------------------------------------
|
| Pastikan alias middleware 'admin' sudah terdaftar di bootstrap/app.php:
| $middleware->alias(['admin' => \App\Http\Middleware\EnsureAdmin::class]);
|
*/
Route::prefix('admin')->name('admin.')->middleware(['web','admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Berita (Posts)
    Route::resource('posts', PostController::class)->except(['show']);

    // Galeri
    Route::resource('gallery', AdminGalleryController::class)->except(['show']);

    // Sarana Prasarana
    Route::resource('sarpras', SarprasController::class)
    ->parameters(['sarpras' => 'sarpras'])
    ->except(['show']);


    // Pesan Masuk (Hubungi Kami)
    Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact.index');
    Route::get('contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact.show');
    Route::delete('contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact.destroy');

    // Pengumuman Berjalan (untuk Home)
     Route::get('announcements', [AnnouncementController::class, 'index'])->name('ann.index');
    Route::post('announcements', [AnnouncementController::class, 'store'])->name('ann.store');
    Route::patch('announcements/{id}/toggle', [AnnouncementController::class, 'toggle'])->name('ann.toggle');
    Route::delete('announcements/{id}', [AnnouncementController::class, 'destroy'])->name('ann.destroy');



    // CRUD Guru & Tendik
    Route::resource('staff', StaffController::class)
        ->parameters(['staff' => 'staff'])
        ->except(['show']);

});
