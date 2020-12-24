<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',function (){
   return view('index');
})->name('product.index');

Route::get('/create',[\App\Http\Controllers\ProductController::class,'create'])->name('product.create');
Route::post('/create',[\App\Http\Controllers\ProductController::class,'store'])->name('product.store');
Route::get('/index',[\App\Http\Controllers\ProductController::class,'render'])->name('product.render');
Route::get('/destroy/{id}',[\App\Http\Controllers\ProductController::class,'destroy'])->name('product.destroy');
Route::post('/update/{id}',[\App\Http\Controllers\ProductController::class,'update'])->name('product.update');
