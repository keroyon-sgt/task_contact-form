<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\ServiceProvider;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsvExportController;

use App\Providers\FortifyServiceProvider;


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

// Route::get('/', function () {return view('welcome');});

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);



// Route::post('/admin', [ContactController::class, 'admin']);
Route::get('/admin', [ContactController::class, 'admin']);
Route::get('/admin/search', [ContactController::class, 'search']);//->name('search')
Route::delete('/admin/delete', [ContactController::class, 'destroy']);

// Route::middleware('auth')->group(function () {
//     Route::get('/admin', [AuthController::class, 'index']);//->name('login')
// });

Route::get('/register', [AuthController::class, 'register_view']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'login_view']);
// Route::post('/login', [AuthController::class, 'login_view'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/thanks', [ContactController::class, 'thanks']);

Route::get('/export', [CsvExportController::class, 'export']);
Route::get('/export/search', [CsvExportController::class, 'search']);

// Route::post('login', [AuthController::class, 'index']);
// Route::post('/login', [AuthController::class, 'store']);

// Route::post('/login_ask', [AuthController::class, 'login']);
// Route::post('/login', [AuthController::class, 'index'])->name('login');

// echo '<br />Auth? ';
// var_dump(Route::middleware('auth'));

// Route::post('/login', [FortifyServiceProvider::class, 'loginView']);

// Route::view('/admin', '/')->middleware('auth'); // ホーム画面の表示処理
// Route::view('/admin', 'admin')->middleware('auth'); // ホーム画面の表示処理The GET method is not supported for this route. Supported methods: POST.


//-------------------------------------------------------------
// Route::get('/', [AuthController::class, 'index']);
// Route::middleware('auth')->group(function () {
//     Route::get('/', [AuthController::class, 'index']);
// });

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
//     Route::resource('/articles', ArticleController::class);
// });

Route::get('/test', [ContactController::class, 'test']);
Route::get('/test_js01', [ContactController::class, 'test_js01']);
Route::get('/test_js02', [ContactController::class, 'test_js02']);