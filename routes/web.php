<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $admin = User::count();
    if (!$admin) {
        $u = new User;
        $u->nama = 'Administrator';
        $u->username = 'admin';
        $u->password = bcrypt('admin');
        $u->jk = 'L';
        $u->level = 'admin';
        $u->save();
    }
    return redirect('/login');
});

Route::get('/'.md5('admin'), [AdminController::class, 'index'])->name('adminIndex');
Route::get('/'.md5('admin').'/profil/{sub}', [AdminController::class, 'profil']);
Route::get('/'.md5('admin').'/profil/sejarah/edit', [AdminController::class, 'profilSejarah']);
Route::post('/'.md5('admin').'/profil/sejarah/edit', [AdminController::class, 'profilSejarahSimpan']);
Route::post('/'.md5('admin').'/profil/struktur', [AdminController::class, 'strukturSimpan']);
Route::get('/'.md5('admin').'/kegiatan/{jenis}/{id?}', [AdminController::class, 'kegiatan']);
Route::post('/'.md5('admin').'/kegiatan/{jenis}/{id?}', [AdminController::class, 'kegiatanTambah']);
Route::delete('/'.md5('admin').'/kegiatan/{jenis}/hapus', [AdminController::class, 'kegiatanHapus']);
Route::get('/'.md5('admin').'/ekstrakurikuler', [AdminController::class, 'ekstrakurikuler']);
Route::post('/'.md5('admin').'/ekstrakurikuler', [AdminController::class, 'ekstrakurikulerTambah']);
Route::get('/'.md5('admin').'/ekstrakurikuler/{id}/edit', [AdminController::class, 'ekstrakurikulerEdit']);
Route::post('/'.md5('admin').'/ekstrakurikuler/{id}/edit', [AdminController::class, 'ekstrakurikulerEditSimpan']);
Route::delete('/'.md5('admin').'/ekstrakurikuler/hapus', [AdminController::class, 'ekstrakurikulerHapus']);
Route::delete('/'.md5('admin').'/prestasi/hapus', [AdminController::class, 'prestasiHapus']);
Route::get('/'.md5('admin').'/prestasi/{id?}', [AdminController::class, 'prestasi']);
Route::post('/'.md5('admin').'/prestasi/{id?}', [AdminController::class, 'prestasiTambah']);
Route::get('/'.md5('admin').'/galeri/{id?}', [AdminController::class, 'galeri']);
Route::post('/'.md5('admin').'/galeri/{id}', [AdminController::class, 'galeriTambah']);
Route::get('/'.md5('admin').'/users/{level}', [AdminController::class, 'users']);
Route::delete('/'.md5('admin').'/users/{level}/hapus', [AdminController::class, 'userHapus']);

Route::get('/'.md5('user'), [UserController::class, 'index'])->name('userIndex');
Route::get('/'.md5('user').'/profil/{sub}', [UserController::class, 'profil']);
Route::get('/'.md5('user').'/kegiatan/{jenis}', [UserController::class, 'kegiatan']);
Route::get('/'.md5('user').'/kegiatan/{jenis}/pengurus', [UserController::class, 'kegiatanPengurus']);
Route::post('/'.md5('user').'/kegiatan/{jenis}/pengurus', [UserController::class, 'kegiatanPengurusTambah']);
Route::get('/'.md5('user').'/ekstrakurikuler', [UserController::class, 'ekstrakurikuler']);
Route::delete('/'.md5('user').'/ekstrakurikuler'.'/'.md5('batal'), [UserController::class, 'ekstrakurikulerBatal']);
Route::get('/'.md5('user').'/ekstrakurikuler/pendaftar/{id?}/{action?}', [UserController::class, 'ekstrakurikulerPendaftar']);
Route::get('/'.md5('user').'/ekstrakurikuler/{id}', [UserController::class, 'ekstrakurikulerFormulir']);
Route::post('/'.md5('user').'/ekstrakurikuler/{id}', [UserController::class, 'ekstrakurikulerFormulirSimpan']);
Route::get('/'.md5('user').'/prestasi', [UserController::class, 'prestasi']);
Route::get('/'.md5('user').'/prestasi/pengurus', [UserController::class, 'prestasiPengurus']);
Route::post('/'.md5('user').'/prestasi/pengurus', [UserController::class, 'prestasiPengurusTambah']);
Route::get('/'.md5('user').'/galeri/{id?}', [UserController::class, 'galeri']);
Route::post('/'.md5('user').'/galeri/{id?}', [UserController::class, 'galeriTambah']);


Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
