<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix'=>'admin','namespace'=>'Admin'],function()
{
    Route::get('/panel', [AdminController::class, 'index'])->name('admin.index');
}
);




Route::group(['prefix'=>'gallery','namespace'=>'Gallery'],function()
{
    Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
}
);
