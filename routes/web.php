<?php

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
