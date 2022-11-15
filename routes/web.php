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


Route::get('/', 'Category@index');
Route::any('/main', 'Category@main');
Route::any('/mainedit/{id}', 'Category@mainedit');
Route::any('/subcate', 'Category@subcate');
Route::any('/subedit/{id}', 'Category@subedit');
Route::any('/subsubcate', 'Category@subsubcate');
Route::any('/subsubedit/{id}', 'Category@subsubedit');
Route::any('/getcate', 'Category@getcate');
Route::any('/getsubcate', 'Category@getsubcate');
Route::any('/product', 'Category@product');