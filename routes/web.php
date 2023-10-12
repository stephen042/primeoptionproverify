<?php

use App\Http\Controllers\Usercontroller;
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

Route::get('/', [Usercontroller::class, "index"])->name("login");
Route::post('/', [Usercontroller::class, "index"])->name("login_post");

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user', [Usercontroller::class, "user"])->name("user");
    Route::put('/user', [Usercontroller::class, "user"])->name("user_put");
    Route::post('invoice/{id}', [Usercontroller::class, "invoice"])->name("invoice_post");
    Route::get('/user/vfy', [Usercontroller::class, "vfy"])->name("vfy");
    Route::post('/user/vfy', [Usercontroller::class, "vfy"])->name("vfy_post");
    Route::get('/user/profile/{User}', [Usercontroller::class, "profile"])->name("profile");
    Route::post('/user/profile/{User}', [Usercontroller::class, "profile"])->name("profile_post");

    // logoout
    Route::post('/user', [Usercontroller::class, "logout"])->name("logout");
});
