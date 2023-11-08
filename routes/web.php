<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\WebsiteController;

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

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/posts/{post}', [WebsiteController::class, 'show'])->name('website.posts.show');

Auth::routes();

Route::get('auth/dashboard', [DashboardController::class, 'dashboard'])->name('auth.dashboard')->middleware('auth');
Route::resource('auth/posts', PostController::class);
