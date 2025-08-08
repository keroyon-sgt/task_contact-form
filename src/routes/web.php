<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
// use App\Http\Controllers\CategoryController;


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
Route::post('/admin', [ContactController::class, 'store']);
Route::post('/register', [ContactController::class, 'store']);
Route::post('/login', [ContactController::class, 'store']);




// Route::middleware('auth')->group(function () {
//     Route::get('/', [AuthController::class, 'index']);
// });
