<?php
use Illuminate\Support\Facades\Route;

Route::get('api/parts/{part}', App\Http\Controllers\Api\Part\IndexController::class);

Route::group(['namespace' => 'App\Http\Controllers\Home'], function (){
    Route::get('/', IndexController::class)->name('index');
    Route::group(['namespace'=>'Post'], function (){
        Route::get('/posts', IndexController::class)->name('posts.index');
    });
    Route::group(['namespace'=>'SpineModel'], function (){
        Route::get('/models', IndexController::class)->name('models.index');
        Route::get('/model/{id}', ShowController::class)->name('models.show');
    });
});

Route::get('/virtualTour', App\Http\Controllers\VirtualTour\IndexController::class)->name('virtualTour.index');

//Для теста. После переделать
Route::get('/login', App\Http\Controllers\Admin\Home\LoginController::class)->name('login');
Route::get('/reg', App\Http\Controllers\Admin\Home\RegistrationController::class)->name('register');

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix' => 'admin'], function(){
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
    Route::group(['namespace' => 'Post'], function(){
        Route::get('/posts', IndexController::class)->name('admin.posts.index');
        Route::get('/posts/create', CreateController::class)->name('admin.post.create');
        Route::post('/posts', StoreController::class)->name('admin.posts.store');
        Route::delete('/posts/{id}', DestroyController::class)->name('admin.posts.destroy');
        Route::get('/posts/{id}/edit', EditController::class)->name('admin.posts.edit');
        Route::patch('/posts/{id}', UpdateController::class)->name('admin.posts.update');
    });
});

Auth::routes();
