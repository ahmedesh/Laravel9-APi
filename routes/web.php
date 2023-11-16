<?php

use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/endpoint', function () {
//    return redirect()->route('welcome');
    return to_route('welcome');  // to_route() => this is built in function == redirect()->route()
});

Route::controller(PostController::class)->group(function () {
    Route::resource('posts', PostController::class);
});

// to stop url of create && edit and update
//Route::resource('posts',PostController::class)->except(['create', 'edit','update']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
