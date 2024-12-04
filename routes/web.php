<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('gallery.index');
})->name('root');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::resource('/albums', AlbumsController::class);
    Route::get('/albums/{album}/photos', [AlbumsController::class, 'getPhotos'])->name('albums.photos');
    Route::resource('/photos', PhotosController::class);
    Route::resource('/categories', CategoryController::class);

});

Route::group(['prefix' => 'gallery'], function () {
    Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/{album}', [GalleryController::class, 'showAlbumPhotos'])->name('gallery.album.photos');
    Route::get('categories/{category}/albums', [GalleryController::class, 'showCategoryAlbums'])->name('gallery.category.albums');
});

require __DIR__ . '/auth.php';
