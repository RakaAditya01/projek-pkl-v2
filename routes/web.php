<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WebcamController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BaranguserController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\ForgotPasswordController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


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

// Route::redirect('/', '/dashboard-general-dashboard');

Route::redirect('/', '/auth-login2',)->middleware('guest');
Route::post('loginproses', [LoginController::class, 'loginproses'])->name('loginproses');

//home
Route::get('/dashboard-general-dashboard', [HomeController::class, 'index'])->name('dashboard-general-dashboard');

// Recaptcha
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);

  
Route::get('auth-forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('auth-forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('auth-reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('auth-reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// webcam
Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');
Route::get('scan', [ScanController::class, 'index'])->name('scan');

// grafik
  
Route::get('/chart', [ChartJSController::class, 'index'])->name('chart');

// Auth
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/auth-login2', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/password', [RegisterController::class])->middleware('password.confirm'); //confirm-password
Route::post('/registeruser', [RegisterController::class, 'registeruser'])->name('registeruser');

// barang
Route::get('/barang', [BarangController::class,'index'])->name('barang');
Route::get('/tambahbarang', [BarangController::class,'tambahbarang'])->name('tambahbarang');
Route::get('/updatebarang/{id}', [BarangController::class,'update'])->name('updatebarang');
Route::get('/tampilanbarang/{id}', [BarangController::class,'tampilanbarang'])->name('tampilanbarang');
Route::post('/insertbarang', [BarangController::class,'store'])->name('insertbarang');
Route::delete('/deletebarang/{id}', [BarangController::class,'destroy'])->name('deletebarang');
// Route::get('/barang/cari',[BarangController::class,'cari'])->name('cari');


// pdf
Route::get('/pdf', [BarangController::class, 'exportPDF']);
Route::get('/pdfuser', [UserController::class, 'pdfuser']);
Route::get('/pdf1', [BarangController::class, 'cetakpdf']);
Route::get('/excel', [BarangController::class,'excel']);
Route::get('/excel1', [PeminjamController::class,'excel1']);

// Peminjaman
Route::get('/peminjaman', [PeminjamController::class,'index'])->name('peminjaman');
Route::get('/tambahpeminjam', [PeminjamController::class,'tambahpeminjam'])->name('tambahpeminjam');
Route::post('/insertpeminjam', [PeminjamController::class,'store'])->name('insertpeminjam');
Route::get('/tampilanpeminjam/{id}', [PeminjamController::class,'tampilanpeminjam'])->name('tampilanpeminjam');
Route::put('/updatepeminjam/{id}', [PeminjamController::class,'update'])->name('updatepeminjam');
Route::delete('/deletepeminjaman/{id}', [PeminjamController::class,'destroy'])->name('deletepeminjaman');
// Route::get('/peminjam/cari',[PeminjamController::class,'cari'])->name('peminjam/cari');
Route::get('/PdfPeminjam', [PeminjamController::class, 'exportPDF']);
// Route::get('/action',[PeminjamController::class,'action'])->name('action');

//user
Route::get('/baranguser', [BaranguserController::class, 'index'])->name('baranguser');
Route::put('/baranguser', [BaranguserController::class, 'baranguser'])->name('baranguser');
Route::get('/pinjamuser/{id}', [BaranguserController::class,'pinjamuser'])->name('pinjamuser');
Route::post('/insertpinjam', [BaranguserController::class,'store'])->name('insertpinjam');

// Profile
Route::get('/features-profile', [ProfileController::class, 'index'])->name('profile');
// Route::get('/edit', [ProfileController::class,'edit'])->name('profile.edit');
Route::put('/update', [ProfileController::class,'update'])->name('update');

// expired
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/tambahuser', [UserController::class,'tambahuser'])->name('tambahuser');
Route::post('/insertuser', [UserController::class,'store'])->name('insertuser');
Route::get('/tampilanuser/{id}', [UserController::class,'tampilanuser'])->name('tampilanuser');
Route::put('/updateuser/{id}', [UserController::class,'update'])->name('updateuser');
Route::delete('/deleteuser/{id}', [UserController::class,'destroy'])->name('deleteuser');
// Route::get('/user/cari',[UserController::class,'cari'])->name('cari');

// auth
Route::group(['middleware' => ['auth','checkrole:admin']],function () {
    Route::get('admin', function () { return view('admin'); })->middleware('checkRole:admin');
    Route::get('mahasiswa', function () { return view('mahasiswa'); })->middleware(['checkRole:mahasiswa,admin']);
});

//history
Route::get('/history', [HistoryController::class, 'index'])->name('history');
Route::post('/deletehistory/{id}', [HistoryController::class,'destroy'])->name('deletehistory');

// webcam
Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');
Route::get('scan', [ScanController::class, 'index'])->name('scan');

// midleware
Route::get('/dashboard-general-dashboard', [HomeController::class, 'index'])->middleware(['auth','checkRole:mahasiswa,admin']);
// Route::get('/barang', [BarangController::class,'index'])->middleware(['auth','checkRole:mahasiswa,admin']);
// Route::get('/peminjaman', [PeminjamController::class,'index'])->middleware(['auth','checkRole:mahasiswa,admin']);
Route::get('webcam', [WebcamController::class, 'index'])->middleware(['auth','checkRole:mahasiswa,admin']);
// Route::get('/user', [UserController::class, 'index'])->middleware(['auth','checkRole:admin']);
Route::get('/baranguser', [BaranguserController::class, 'index'])->middleware(['auth','checkRole:mahasiswa']);
Route::get('/history', [HistoryController::class, 'index'])->middleware(['auth','checkRole:mahasiswa']);
// --------------------------------------------------------------------------------------------------------------------- //

// Dashboard
// Route::get('/dashboard-general-dashboard', function () {
//     return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
// });
// Route::get('/dashboard-ecommerce-dashboard', function () {
//     return view('pages.dashboard-ecommerce-dashboard', ['type_menu' => 'dashboard']);
// });


// Layout
Route::get('/layout-default-layout', function () {
    return view('pages.layout-default-layout', ['type_menu' => 'layout']);
});

// Blank Page
Route::get('/blank-page', function () {
    return view('pages.blank-page', ['type_menu' => '']);
});

// Bootstrap
Route::get('/bootstrap-alert', function () {
    return view('pages.bootstrap-alert', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-badge', function () {
    return view('pages.bootstrap-badge', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-breadcrumb', function () {
    return view('pages.bootstrap-breadcrumb', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-buttons', function () {
    return view('pages.bootstrap-buttons', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-card', function () {
    return view('pages.bootstrap-card', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-carousel', function () {
    return view('pages.bootstrap-carousel', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-collapse', function () {
    return view('pages.bootstrap-collapse', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-dropdown', function () {
    return view('pages.bootstrap-dropdown', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-form', function () {
    return view('pages.bootstrap-form', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-list-group', function () {
    return view('pages.bootstrap-list-group', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-media-object', function () {
    return view('pages.bootstrap-media-object', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-modal', function () {
    return view('pages.bootstrap-modal', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-nav', function () {
    return view('pages.bootstrap-nav', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-navbar', function () {
    return view('pages.bootstrap-navbar', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-pagination', function () {
    return view('pages.bootstrap-pagination', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-popover', function () {
    return view('pages.bootstrap-popover', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-progress', function () {
    return view('pages.bootstrap-progress', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-table', function () {
    return view('pages.bootstrap-table', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-tooltip', function () {
    return view('pages.bootstrap-tooltip', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-typography', function () {
    return view('pages.bootstrap-typography', ['type_menu' => 'bootstrap']);
});


// components
Route::get('/components-article', function () {
    return view('pages.components-article', ['type_menu' => 'components']);
});
Route::get('/components-avatar', function () {
    return view('pages.components-avatar', ['type_menu' => 'components']);
});
Route::get('/components-chat-box', function () {
    return view('pages.components-chat-box', ['type_menu' => 'components']);
});
Route::get('/components-empty-state', function () {
    return view('pages.components-empty-state', ['type_menu' => 'components']);
});
Route::get('/components-gallery', function () {
    return view('pages.components-gallery', ['type_menu' => 'components']);
});
Route::get('/components-hero', function () {
    return view('pages.components-hero', ['type_menu' => 'components']);
});
Route::get('/components-multiple-upload', function () {
    return view('pages.components-multiple-upload', ['type_menu' => 'components']);
});
Route::get('/components-pricing', function () {
    return view('pages.components-pricing', ['type_menu' => 'components']);
});
Route::get('/components-statistic', function () {
    return view('pages.components-statistic', ['type_menu' => 'components']);
});
Route::get('/components-tab', function () {
    return view('pages.components-tab', ['type_menu' => 'components']);
});
Route::get('/components-table', function () {
    return view('pages.components-table', ['type_menu' => 'components']);
});
Route::get('/components-user', function () {
    return view('pages.components-user', ['type_menu' => 'components']);
});
Route::get('/components-wizard', function () {
    return view('pages.components-wizard', ['type_menu' => 'components']);
});

// forms
Route::get('/forms-advanced-form', function () {
    return view('pages.forms-advanced-form', ['type_menu' => 'forms']);
});
Route::get('/forms-editor', function () {
    return view('pages.forms-editor', ['type_menu' => 'forms']);
});
Route::get('/forms-validation', function () {
    return view('pages.forms-validation', ['type_menu' => 'forms']);
});

// google maps
// belum tersedia

// modules
Route::get('/modules-calendar', function () {
    return view('pages.modules-calendar', ['type_menu' => 'modules']);
});
Route::get('/modules-chartjs', function () {
    return view('pages.modules-chartjs', ['type_menu' => 'modules']);
});
Route::get('/modules-datatables', function () {
    return view('pages.modules-datatables', ['type_menu' => 'modules']);
});
Route::get('/modules-flag', function () {
    return view('pages.modules-flag', ['type_menu' => 'modules']);
});
Route::get('/modules-font-awesome', function () {
    return view('pages.modules-font-awesome', ['type_menu' => 'modules']);
});
Route::get('/modules-ion-icons', function () {
    return view('pages.modules-ion-icons', ['type_menu' => 'modules']);
});
Route::get('/modules-owl-carousel', function () {
    return view('pages.modules-owl-carousel', ['type_menu' => 'modules']);
});
Route::get('/modules-sparkline', function () {
    return view('pages.modules-sparkline', ['type_menu' => 'modules']);
});
Route::get('/modules-sweet-alert', function () {
    return view('pages.modules-sweet-alert', ['type_menu' => 'modules']);
});
Route::get('/modules-toastr', function () {
    return view('pages.modules-toastr', ['type_menu' => 'modules']);
});
Route::get('/modules-vector-map', function () {
    return view('pages.modules-vector-map', ['type_menu' => 'modules']);
});
Route::get('/modules-weather-icon', function () {
    return view('pages.modules-weather-icon', ['type_menu' => 'modules']);
});

// auth
Route::get('/auth-forgot-password', function () {
    return view('pages.auth-forgot-password', ['type_menu' => 'auth']);
});
Route::get('/auth-login', function () {
    return view('pages.auth-login', ['type_menu' => 'auth']);
});
Route::get('/auth-login2', function () {
    return view('pages.auth-login2', ['type_menu' => 'auth']);
});
Route::get('/auth-register', function () {
    return view('pages.auth-register', ['type_menu' => 'auth']);
});
Route::get('/auth-reset-password', function () {
    return view('pages.auth-reset-password', ['type_menu' => 'auth']);
});

// error
Route::get('/error-403', function () {
    return view('pages.error-403', ['type_menu' => 'error']);
});
Route::get('/error-404', function () {
    return view('pages.error-404', ['type_menu' => 'error']);
});
Route::get('/error-500', function () {
    return view('pages.error-500', ['type_menu' => 'error']);
});
Route::get('/error-503', function () {
    return view('pages.error-503', ['type_menu' => 'error']);
});

// features
Route::get('/features-activities', function () {
    return view('pages.features-activities', ['type_menu' => 'features']);
});
Route::get('/features-post-create', function () {
    return view('pages.features-post-create', ['type_menu' => 'features']);
});
Route::get('/features-post', function () {
    return view('pages.features-post', ['type_menu' => 'features']);
});
Route::get('/features-profile', function () {
    return view('pages.features-profile', ['type_menu' => 'features']);
});
Route::get('/features-settings', function () {
    return view('pages.features-settings', ['type_menu' => 'features']);
});
Route::get('/features-setting-detail', function () {
    return view('pages.features-setting-detail', ['type_menu' => 'features']);
});
Route::get('/features-tickets', function () {
    return view('pages.features-tickets', ['type_menu' => 'features']);
});

// utilities
Route::get('/utilities-contact', function () {
    return view('pages.utilities-contact', ['type_menu' => 'utilities']);
});
Route::get('/utilities-invoice', function () {
    return view('pages.utilities-invoice', ['type_menu' => 'utilities']);
});
Route::get('/utilities-subscribe', function () {
    return view('pages.utilities-subscribe', ['type_menu' => 'utilities']);
});

// credits
Route::get('/credits', function () {
    return view('pages.credits', ['type_menu' => '']);
});
