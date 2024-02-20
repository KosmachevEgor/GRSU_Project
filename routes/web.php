<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers\Home'], function (){
    Route::get('/', IndexController::class);
});

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix' => 'admin'], function(){
    Route::group(['namespace' => 'Home'], function (){
        Route::get('/', IndexController::class);
    });
    Route::group(['namespace' => 'SpineModel'], function (){
        Route::get('/models', IndexController::class)->name('admin.models.index');
        Route::get('/models/create', CreateController::class)->name('admin.models.create');
        Route::post('/models', StoreController::class)->name('admin.models.store');
    });
});

Auth::routes();
