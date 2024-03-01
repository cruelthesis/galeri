<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PostApproveController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index']);
Route::get('register', [UserController::class, 'register']);

Route::post('daftar', [UserController::class, 'store']);
Route::post('masuk', [UserController::class, 'masuk']);

Route::get('logout', [UserController::class, 'logout']);

Route::get('login/admin', [AdminController::class, 'tampilLogin']);
Route::post('loginpost/admin', [AdminController::class, 'login']);

Route::get('logoutAdmin', [AdminController::class, 'logout']);

Route::group(['middleware' => ['auth']], function(){

    Route::post('updateuser/{id}', [UserController::class,'update']);
    
    Route::resource('galeri', GaleriController::class);

    // Route::get('admin', [AdminController::class, 'index']);
    Route::resource('admin', AdminController::class);

    Route::get('approval/{id}', [AdminController::class, 'approval']);

    Route::resource('approve', PostApproveController::class);

    Route::get('decline', [PostApproveController::class, 'indexDecline']);

    

});



