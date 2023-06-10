<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductsController;



Route::get('/', function () {
    return view('web.catalogo');
});

Auth::routes(['verify'=>true]);


Route::group(['middleware'=>['auth'],'prefix'=>'admin'],function(){
    Route::group(['prefix'=>'roles'],function(){
        Route::get('/',[RolesController::class,'index'])
            ->middleware(['permission:ver-usuario'])
            ->name('roles.index');
        Route::get('/create',[RolesController::class,'create'])
            ->middleware(['permission:crear-usuario'])
            ->name('roles.create');
        Route::put('/update/{id}',[RolesController::class,'update'])
            ->middleware(['permission:editar-usuario'])
            ->name('roles.update');
        Route::delete('/delete/{id}',[RolesController::class,'delete'])
            ->middleware(['permission:borar-usuario'])
            ->name('roles.delete');
    });

    Route::group(['prefix'=>'usuarios'],function(){
        Route::get('/',[UserController::class,'index'])
            ->middleware(['permission:view-users'])
            ->name('usuarios.index');
        Route::get('/all',[UserController::class,'all'])
            ->middleware(['permission:view-users'])
            ->name('usuarios.all');
        Route::get('/create',[UserController::class,'create'])
            ->middleware(['permission:create-users'])
            ->name('usuarios.create');
        Route::put('/update/{id}',[UserController::class,'update'])
            ->middleware(['permission:edit-users'])
            ->name('usuarios.update');
        Route::put('/update_status/{id}',[UserController::class,'updateStatus'])
            ->middleware(['permission:edit-users'])
            ->name('usuarios.update.status');
        Route::delete('/delete/{id}',[UserController::class,'delete'])
            ->middleware(['permission:delete-users'])
            ->name('usuarios.delete');
    });

    // Route::resource('usuarios',UsuarioController::class);
    Route::get('usuarios/index',[UserController::class,'index']);

    Route::group(['prefix'=>'productos'],function(){
        Route::get('/',[ProductsController::class,'index'])
            ->middleware(['permission:ver-products'])
            ->name('productos.index');
        Route::get('/all',[ProductsController::class,'all'])
            ->middleware(['permission:ver-products'])
            ->name('productos.all');
        Route::get('/create',[ProductsController::class,'create'])
            ->middleware(['permission:crear-products'])
            ->name('productos.create');
        Route::post('/store',[ProductsController::class,'store'])
            ->middleware(['permission:crear-products'])
            ->name('productos.store');
        Route::post('/edit/{id}',[ProductsController::class,'edit'])
            ->middleware(['permission:editar-products'])
            ->name('productos.edit');
        Route::put('/update/{id}',[ProductsController::class,'update'])
            ->middleware(['permission:editar-products'])
            ->name('productos.update');
        Route::delete('/delete/{id}',[ProductsController::class,'delete'])
            ->middleware(['permission:borar-products'])
            ->name('productos.delete');
    });
});


