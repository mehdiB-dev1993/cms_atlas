<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use \App\Http\Controllers\SliderController;

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
    Route::get('/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::post('/update', [GalleryController::class, 'update'])->name('gallery.update');
}
);




Route::group(['prefix'=>'slider','namespace'=>'Slider'],function()
{
    Route::get('/', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'update'])->name('slider.update');

}
);
