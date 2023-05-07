<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;


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
        Route::get('/',[App\Http\Controllers\UsuarioController::class,'index'])->middleware(['permission:ver-usuario'])->name('usuarios.index');
        Route::get('/all',[App\Http\Controllers\UsuarioController::class,'all'])->middleware(['permission:ver-usuario'])->name('usuarios.all');
        Route::get('/create',[App\Http\Controllers\UsuarioController::class,'create'])->middleware(['permission:crear-usuario'])->name('usuarios.create');
        Route::put('/update/{id}',[App\Http\Controllers\UsuarioController::class,'update'])->middleware(['permission:editar-usuario'])->name('usuarios.update');
        Route::put('/update_status/{id}',[App\Http\Controllers\UsuarioController::class,'updateStatus'])->middleware(['permission:editar-usuario'])->name('usuarios.update.status');
        Route::delete('/delete/{id}',[App\Http\Controllers\UsuarioController::class,'delete'])->middleware(['permission:borar-usuario'])->name('usuarios.delete');
    });

    Route::group(['prefix'=>'productos'],function(){
        Route::get('/',[App\Http\Controllers\UsuarioController::class,'index'])->middleware(['permission:ver-productos'])->name('productos.index');
        Route::get('/all',[App\Http\Controllers\UsuarioController::class,'all'])->middleware(['permission:ver-productos'])->name('productos.all');
        Route::get('/create',[App\Http\Controllers\UsuarioController::class,'create'])->middleware(['permission:crear-productos'])->name('productos.create');
        Route::put('/update/{id}',[App\Http\Controllers\UsuarioController::class,'update'])->middleware(['permission:editar-productos'])->name('productos.update');
        Route::delete('/delete/{id}',[App\Http\Controllers\UsuarioController::class,'delete'])->middleware(['permission:borar-productos'])->name('productos.delete');
    });


    // Route::resource('usuarios',UsuarioController::class);

    Route::get('usuarios/index',[UsuarioController::class,'index']);
});
