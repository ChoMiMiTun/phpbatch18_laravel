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

// Route::get('/', function () {
//     return view('welcome');
// })->name('homepage');

// Route::get('testing', function(){
// 	return view('testing');
// })->name('testingpage');

// using frontend_asset (ui)

// Route::get('/', 'MainController@welcome')->name('homepage');

// Route::get('testing', 'MainController@testing')->name('testingpage');

// Route::get('about', 'MainController@about')->name('aboutpage');

// Route::get('contact', 'MainController@contact')->name('contactpage');

Route::resource('brand', 'BrandController');

Route::resource('category', 'CategoryController');

Route::resource('subcategory', 'SubcategoryController');

Route::resource('item', 'ItemController');

Route::post('filter', 'ItemController@filterCategory')->name('filterCategory');

// Frontend with items
Route::get('/', 'FrontendController@home')->name('mainpage');
