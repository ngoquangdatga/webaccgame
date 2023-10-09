<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\PhukienController;



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

Route::get('/',[IndexController::class,'home']);
Route::get('/dich-vu',[IndexController::class,'dichvu'])->name('dichvu');
Route::get('/dich-vu/{slug}',[IndexController::class,'dichvucon'])->name('dichvucon');
Route::get('/danh-muc-game/{slug}',[IndexController::class,'danhmuc_game'])->name('danhmucgame');
Route::get('/danh-muc/{slug}',[IndexController::class,'danhmuccon'])->name('danhmuccon');
Route::get('/blog',[IndexController::class,'blogs'])->name('blog');
Route::get('/post/{slug}',[IndexController::class,'blogs_detail'])->name('blogs_detail');
Route::get('/video-highlight',[IndexController::class,'video_highlight'])->name('video-highlight');
Route::post('/show_videos',[IndexController::class,'show_videos'])->name('show_videos');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::resource('/category',CategoryController::class);
Route::resource('/slider',sliderController::class);
Route::resource('/blogs',BlogsController::class);
Route::resource('/videos',VideosController::class);
Route::resource('/phukien',PhukienController::class);
