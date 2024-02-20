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

Route::get("/info", function () {
    return phpinfo();
});

Route::group(['namespace' => 'App\Http\Controllers\Home'], function (){
    Route::get('/', IndexController::class);
});

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix' => 'admin'], function(){
    Route::group(['namespace' => 'Home'], function (){
        Route::get('/', IndexController::class)->name('admin.index');
    });
    Route::group(['namespace' => 'SpineModel'], function (){
        Route::get('/models', IndexController::class)->name('admin.models.index');
        Route::get('/models/create', CreateController::class)->name('admin.models.create');
        Route::post('/models', StoreController::class)->name('admin.models.store');
    });

    Route::group(['namespace' => 'SpinePart'], function (){
        Route::get('/parts', IndexController::class)->name('admin.parts.index');
        Route::get('/parts/create', CreateController::class)->name('admin.parts.create');
        Route::post('/parts', StoreController::class)->name('admin.parts.store');
    });
});

Auth::routes();
