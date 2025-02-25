<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use \App\Http\Controllers\SliderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseGroupController;

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


Route::group(['prefix' => 'menu'], function ()
{
    Route::get('/list', [MenuController::class,'index'])->name('menu.index');
    Route::get('/create', [MenuController::class,'create'])->name('menu.create');
    Route::post('/store', [MenuController::class,'store'])->name('menu.store');
    Route::get('/destroy/{id}', [MenuController::class,'destroy'])->name('menu.destroy');
    Route::get('/edit/{id}', [MenuController::class,'edit'])->name('menu.edit');
    Route::post('/update', [MenuController::class,'update'])->name('menu.update');

}
);


Route::group(['prefix' => 'page'], function ()
{
    Route::get('/list',[PageController::class,'index'])->name('page.index');
    Route::get('/create', [PageController::class,'create'])->name('page.create');
    Route::post('/store', [PageController::class,'store'])->name('page.store');
    Route::get('/edit/{id}', [PageController::class,'edit'])->name('page.edit');
    Route::post('/update', [PageController::class,'update'])->name('page.update');
    Route::get('/destroy/{id}', [PageController::class,'destroy'])->name('page.destroy');
}
);




Route::group(['prefix' => 'course'], function ()
{
    Route::get('/list',[CourseController::class,'index'])->name('course.index');

}
);

Route::group(['prefix' => 'course_group'], function ()
{
    Route::get('/list',[CourseGroupController::class,'index'])->name('course_group.index');
    Route::get('/create', [CourseGroupController::class,'create'])->name('course_group.create');
    Route::post('/store', [CourseGroupController::class,'store'])->name('course_group.store');
    Route::get('/edit/{id}', [CourseGroupController::class,'edit'])->name('course_group.edit');
    Route::post('/update', [CourseGroupController::class,'update'])->name('course_group.update');
    Route::get('/destroy/{id}', [CourseGroupController::class,'destroy'])->name('course_group.destroy');

}
);

