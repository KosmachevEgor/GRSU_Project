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
    Route::get('/home', IndexController::class)->name('index');
});

//Для теста. После переделать
Route::get('/login', App\Http\Controllers\Admin\Home\LoginController::class)->name('login');
Route::get('/reg', App\Http\Controllers\Admin\Home\RegistrationController::class)->name('register');

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware'=>'admin.auth'], function(){
    Route::group(['namespace' => 'Home'], function (){
        Route::get('/', IndexController::class)->name('admin.index');
    });
    Route::group(['namespace' => 'SpineModel'], function (){
        Route::get('/models', IndexController::class)->name('admin.models.index');
        Route::get('/models/create', CreateController::class)->name('admin.models.create');
        Route::get('/models/{id}', ShowController::class)->name('admin.models.show');
        Route::post('/models', StoreController::class)->name('admin.models.store');
        Route::delete('/models/{id}', DestroyController::class)->name('admin.models.destroy');
        Route::get('/models/{id}/edit', EditController::class)->name('admin.models.edit');
        Route::patch('/models/{id}', UpdateController::class)->name('admin.models.update');
    });

    Route::group(['namespace' => 'SpinePart'], function (){
        Route::get('/parts', IndexController::class)->name('admin.parts.index');
        Route::get('/parts/create', CreateController::class)->name('admin.parts.create');
        Route::post('/parts', StoreController::class)->name('admin.parts.store');
        Route::delete('/parts/{id}', DestroyController::class)->name('admin.parts.destroy');
        Route::get('/parts/{id}/edit', EditController::class)->name('admin.parts.edit');
        Route::patch('/parts/{id}', UpdateController::class)->name('admin.parts.update');
    });
});

Auth::routes();
