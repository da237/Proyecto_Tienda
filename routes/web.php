<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\CatalogController;
include __DIR__."/admin.php";


Route::get('/catalogo', function () {
    return view('web.catalogo');
});

Auth::routes(['verify'=>true]);

Route::get('/', function () {
    return view('web.inicio');
});

Route::group(['prefix'=>'catalog',],function(){

    Route::get('/products',[CatalogController::class,'index'])->name('catalogo.getProducts');
});


