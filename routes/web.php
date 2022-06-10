<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('home');
});

Auth::routes([
    'login' => false,
    'register' => false,
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/posts/{id}', [HomeController::class, 'post']);
Route::get('/categories', [HomeController::class, 'categories']);
Route::get('/categories/{category}/posts', [HomeController::class, 'postsByCategory']);

Route::get('/book/{id}/order', [OrderController::class, "create"]);
Route::post('/book/{id}/order', [OrderController::class, "store"]);

Route::get('/about', fn () => view('about'));
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'sendMail']);

Route::get('/phone-stl', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/phone-stl', [LoginController::class, 'login']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/', [DashboardController::class, 'updateOrCreate']);
    Route::resource("category", CategoryController::class);
    Route::resource("post", PostController::class);
    Route::post('/ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');
    Route::resource('book', BookController::class);
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::put('/order/{order}/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::put('/order/{order}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
});
