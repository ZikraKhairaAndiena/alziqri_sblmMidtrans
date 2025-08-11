 <?php

use App\Http\Controllers\AdminPpdbController;
use App\Http\Controllers\FonnteController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\ThnAjaranController;
use App\Http\Controllers\UserController;
use App\Models\Pembayaran;
use App\Models\Ppdb;
use App\Models\Thn_ajaran;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route untuk halaman home
// Route::get('/home', function () {return view('umum.home');})->name('umum.home');
Route::view('/', 'umum.home')->name('umum.home');

// Route untuk halaman profil
Route::get('/profil', function () {return view('umum.profil');})->name('umum.profil');

// Route untuk halaman kegiatan
Route::get('/kegiatan', function () {return view('umum.kegiatan');})->name('umum.kegiatan');

// Route untuk halaman kontak
Route::get('/kontak', function () {return view('umum.kontak');})->name('umum.kontak');

// Route login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route registrasi
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Route untuk halaman dashboard
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/fonnte', [FonnteController::class, 'index'])->name('admin.fonnte.index');
    Route::post('/fonnte/send', [FonnteController::class, 'send'])->name('admin.fonnte.send');
});

// Route untuk halaman user
Route::get('/user', [UserController::class, 'index'])->name('admin.pengguna.index');
Route::get('/user/create', [UserController::class, 'create'])->name('admin.pengguna.create');
Route::post('/user', [UserController::class, 'store'])->name('admin.pengguna.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.pengguna.edit');
Route::get('/user/{id}', [UserController::class, 'show'])->name('admin.pengguna.show');
Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.pengguna.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.pengguna.destroy');

// Route untuk halaman guru
Route::get('/guru', [GuruController::class, 'index'])->name('admin.guru.index');
Route::get('/guru/create', [GuruController::class, 'create'])->name('admin.guru.create');
Route::post('/guru', [GuruController::class, 'store'])->name('admin.guru.store');
Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('admin.guru.edit');
Route::get('/guru/{id}', [GuruController::class, 'show'])->name('admin.guru.show');
Route::put('/guru/{id}', [GuruController::class, 'update'])->name('admin.guru.update');
Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');

//Route untuk halaman PPDB orang tua
Route::middleware(['auth', 'role:orang_tua'])->prefix('orang_tua/ppdb')->name('orang_tua.ppdb.')->group(function () {
    Route::get('/', [PpdbController::class, 'index'])->name('index');
    Route::get('/create', [PpdbController::class, 'create'])->name('create');
    Route::post('/', [PpdbController::class, 'store'])->name('store');
});

// Route untuk halaman PPDB admin
Route::middleware(['auth', 'role:admin'])->prefix('admin/ppdb') ->name('admin.ppdb.')->group(function () {
    Route::get('/', [AdminPpdbController::class, 'index'])->name('admin');
    Route::get('/{id}', [AdminPpdbController::class, 'show'])->name('show');
    Route::post('/{id}/verifikasi', [AdminPpdbController::class, 'verifikasi'])->name('verifikasi');
});

// Route untuk halaman siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('admin.siswa.show');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');

Route::middleware(['auth', 'check.ppdb'])->group(function () {
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('admin.pembayaran.create');
    Route::post('/pembayaran/store', [PembayaranController::class, 'store']) ->name('admin.pembayaran.store');
    Route::get('/pembayaran/success', [PembayaranController::class, 'success'])->name('admin.pembayaran.success');

    Route::get('/kehadiran/ortu', [KehadiranController::class, 'index'])->name('admin.kehadiran.ortu');
    Route::get('/tabungan/ortu', [TabunganController::class, 'index'])->name('admin.tabungan.ortu');
    // Route::get('/rapor', [RaporController::class, 'index'])->name('rapor.index');
});

// Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('admin.pembayaran.create');
// Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('admin.pembayaran.store');
// Route::get('/pembayaran/success', [PembayaranController::class, 'success'])->name('admin.pembayaran.success');
Route::post('/midtrans/callback', [PembayaranController::class, 'callback']);

// Halaman pending
Route::view('/pending', 'admin.pending')->name('admin.pending');

//Route untuk halaman tabungan guru
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/tabungan', [TabunganController::class, 'index'])->name('admin.tabungan.index');
    Route::get('/tabungan/create', [TabunganController::class, 'create'])->name('admin.tabungan.create');
    Route::post('/tabungan', [TabunganController::class, 'store'])->name('admin.tabungan.store');

    Route::get('/kehadiran', [KehadiranController::class, 'index'])->name('admin.kehadiran.index');
    Route::get('/kehadiran/create', [KehadiranController::class, 'create'])->name('admin.kehadiran.create');
    Route::post('/kehadiran', [KehadiranController::class, 'store'])->name('admin.kehadiran.store');
    Route::get('/kehadiran/{id}', [KehadiranController::class, 'show'])->name('admin.kehadiran.show');
    // Route::get('/kehadiran/{id}/edit', [KehadiranController::class, 'edit'])->name('kehadiran.edit');
    // Route::put('/kehadiran/{id}', [KehadiranController::class, 'update'])->name('admin.kehadiran.update');
    Route::delete('/kehadiran/{id}', [KehadiranController::class, 'destroy'])->name('admin.kehadiran.destroy');
});

// Route untuk halaman tahun ajaran
Route::get('/thn_ajaran', [ThnAjaranController::class, 'index'])->name('admin.thn_ajaran.index');
Route::get('/thn_ajaran/create', [ThnAjaranController::class, 'create'])->name('admin.thn_ajaran.create');
Route::post('/thn_ajaran', [ThnAjaranController::class, 'store'])->name('admin.thn_ajaran.store');
Route::get('/thn_ajaran/{id}/edit', [ThnAjaranController::class, 'edit'])->name('admin.thn_ajaran.edit');
Route::get('/thn_ajaran/{id}', [ThnAjaranController::class, 'show'])->name('admin.thn_ajaran.show');
Route::put('/thn_ajaran/{id}', [ThnAjaranController::class, 'update'])->name('admin.thn_ajaran.update');
Route::delete('/thn_ajaran/{id}', [ThnAjaranController::class, 'destroy'])->name('admin.thn_ajaran.destroy');
