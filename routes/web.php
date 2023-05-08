<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductsController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth']],function(){
    Route::group(['prefix'=>'roles'],function(){
        Route::get('/',[App\Http\Controllers\RolController::class,'index'])->middleware(['permission:ver-usuario'])->name('roles.index');
        Route::get('/create',[App\Http\Controllers\RolController::class,'create'])->middleware(['permission:crear-usuario'])->name('roles.create');
        Route::put('/update/{id}',[App\Http\Controllers\RolController::class,'update'])->middleware(['permission:editar-usuario'])->name('roles.update');
        Route::delete('/delete/{id}',[App\Http\Controllers\RolController::class,'delete'])->middleware(['permission:borar-usuario'])->name('roles.delete');
    });

    Route::group(['prefix'=>'usuarios'],function(){
        Route::get('/',[App\Http\Controllers\UsuarioController::class,'index'])
            ->middleware(['permission:view-users'])
            ->name('usuarios.index');
        Route::get('/all',[App\Http\Controllers\UsuarioController::class,'all'])
            ->middleware(['permission:view-users'])
            ->name('usuarios.all');
        Route::get('/create',[App\Http\Controllers\UsuarioController::class,'create'])->middleware(['permission:create-users'])->name('usuarios.create');
        Route::put('/update/{id}',[App\Http\Controllers\UsuarioController::class,'update'])->middleware(['permission:edit-users'])->name('usuarios.update');
        Route::put('/update_status/{id}',[App\Http\Controllers\UsuarioController::class,'updateStatus'])->middleware(['permission:edit-users'])->name('usuarios.update.status');
        Route::delete('/delete/{id}',[App\Http\Controllers\UsuarioController::class,'delete'])->middleware(['permission:delete-users'])->name('usuarios.delete');
    });

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
        Route::put('/update/{id}',[ProductsController::class,'update'])
            ->middleware(['permission:editar-products'])
            ->name('productos.update');
        Route::delete('/delete/{id}',[ProductsController::class,'delete'])
            ->middleware(['permission:borar-products'])
            ->name('productos.delete');
    });


    // Route::resource('usuarios',UsuarioController::class);

    Route::get('usuarios/index',[UsuarioController::class,'index']);
});
