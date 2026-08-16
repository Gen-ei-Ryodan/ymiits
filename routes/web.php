<?php

use App\Http\Controllers\Admin\DewanYayasanController;
use App\Http\Controllers\Admin\DonaturController;
use App\Http\Controllers\Admin\FotoPendiriController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeAngkaController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PendiriPembinaController;
use App\Http\Controllers\Admin\PenerimaManfaatController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\ProgramKeagamaanController;
use App\Http\Controllers\Admin\ProgramKemanusiaanController;
use App\Http\Controllers\Admin\ProgramSosialKeumatanController;
use App\Http\Controllers\Admin\ProgramSosialPendidikanController;
use App\Http\Controllers\Admin\ProgramWakafController;
use App\Http\Controllers\Admin\SubProgramKeagamaanController;
use App\Http\Controllers\Admin\SubProgramKemanusiaanController;
use App\Http\Controllers\Admin\SubProgramSosialKeumatanController;
use App\Http\Controllers\Admin\SubProgramSosialPendidikanController;
use App\Http\Controllers\Admin\SubProgramWakafController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/homeprofile', [HomeController::class, 'profile'])->name('homeprofile');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/news/{id}', [HomeController::class, 'showNews'])->name('news.detail');
// Halaman Program
Route::get('/programs/keagamaan', [HomeController::class, 'keagamaan'])->name('programs.keagamaan');
Route::get('/programs/sosialkeumatan', [HomeController::class, 'sosialkeumatan'])->name('programs.sosialkeumatan');
Route::get('/programs/pendidikan', [HomeController::class, 'pendidikan'])->name('programs.pendidikan');
Route::get('/programs/kemanusiaan', [HomeController::class, 'kemanusiaan'])->name('programs.kemanusiaan');
Route::get('/programs/wakaf', [HomeController::class, 'wakaf'])->name('programs.wakaf');

// Redirect default Breeze dashboard to Admin dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin Routes Group - Satu grup untuk semua route admin
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        // Gallery Routes
        Route::resource('galeri', GalleryController::class);
        Route::resource('news', NewsController::class);
        Route::resource('pendiri-pembina', PendiriPembinaController::class);
        Route::resource('dewan-yayasan', DewanYayasanController::class);
        Route::resource('pengurus', PengurusController::class)->parameters([
            'pengurus' => 'pengurus',
        ]);

        Route::resource('donatur', DonaturController::class);
        Route::resource('penerima-manfaat', PenerimaManfaatController::class);
        Route::resource('testimoni', TestimoniController::class);
        Route::post('testimoni/{id}/toggle-active', [App\Http\Controllers\Admin\TestimoniController::class, 'toggleActive'])->name('testimoni.toggle-active');
        Route::resource('keagamaan', ProgramKeagamaanController::class);
        Route::resource('sosial-keumatan', ProgramSosialKeumatanController::class);
        Route::resource('sosial-pendidikan', ProgramSosialPendidikanController::class);
        Route::resource('kemanusiaan', ProgramKemanusiaanController::class);
        Route::resource('wakaf', ProgramWakafController::class);
        Route::resource('homeangka', HomeAngkaController::class);
        Route::resource('home-banner', HomeBannerController::class);
        Route::get('foto-pendiri', [FotoPendiriController::class, 'index'])->name('foto-pendiri.index');
        Route::get('foto-pendiri/create', [FotoPendiriController::class, 'create'])->name('foto-pendiri.create');
        Route::post('foto-pendiri', [FotoPendiriController::class, 'store'])->name('foto-pendiri.store');
        Route::get('foto-pendiri/{id}/edit', [FotoPendiriController::class, 'edit'])->name('foto-pendiri.edit');
        Route::put('foto-pendiri/{id}', [FotoPendiriController::class, 'update'])->name('foto-pendiri.update');
        
        // Sub Program Routes
        Route::resource('sub-program-keagamaan', \App\Http\Controllers\Admin\SubProgramKeagamaanController::class)->names([
            'create' => 'sub-program.create',
            'store' => 'sub-program.store',
            'edit' => 'sub-program.edit',
            'update' => 'sub-program.update',
            'destroy' => 'sub-program.destroy',
        ])->except(['index', 'show']);
        
        Route::resource('sub-program-kemanusiaan', \App\Http\Controllers\Admin\SubProgramKemanusiaanController::class)->only([
            'index', 'store', 'edit', 'update', 'destroy',
        ]);
        
        Route::resource('sub-program-sosial-keumatan', \App\Http\Controllers\Admin\SubProgramSosialKeumatanController::class)->only([
            'index', 'store', 'edit', 'update', 'destroy',
        ]);
        
        Route::resource('sub-program-sosial-pendidikan', \App\Http\Controllers\Admin\SubProgramSosialPendidikanController::class)->only([
            'index', 'store', 'edit', 'update', 'destroy',
        ]);
        
        Route::resource('sub-program-wakaf', \App\Http\Controllers\Admin\SubProgramWakafController::class)->only([
            'index', 'store', 'edit', 'update', 'destroy',
        ])->names([
            'store' => 'wakaf.sub.store',
            'edit' => 'wakaf.sub.edit',
            'update' => 'wakaf.sub.update',
            'destroy' => 'wakaf.sub.destroy',
        ]);
    });

// Profile routes dari Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
