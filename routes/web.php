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

Route::get('/home' , 'App\Http\Controllers\Homecontroller@home')->name('home');

Route::get('/', function () {
    return view('frontend.index');
});

//Frontend Route
Route::get('about', 'App\Http\Controllers\Homecontroller@about')->name('about');


Route::group(['middleware' => 'auth'] , function(){
    

});

Route::group(['middleware' => ['auth','admin']] , function(){
    Route::get('/admin/category' , 'App\Http\Controllers\Categorycontroller@index')->name('category.index');
    Route::get('/admin/category/create' , 'App\Http\Controllers\Categorycontroller@create')->name('category.create');
    Route::post('/admin/category/store' , 'App\Http\Controllers\Categorycontroller@store')->name('category.store');
    Route::post('/admin/category/update' , 'App\Http\Controllers\Categorycontroller@update')->name('category.update');
    Route::get('/admin/category/edit/{id}' , 'App\Http\Controllers\Categorycontroller@edit')->name('category.edit');
    Route::get('/admin/category/delete/{id}' , 'App\Http\Controllers\Categorycontroller@delete')->name('category.delete');


    // Route For Post
    
    Route::get('/admin/post/delete/{id}' , 'App\Http\Controllers\Postcontroller@delete')->name('posts.delete');
    Route::resource('posts', 'App\Http\Controllers\Postcontroller');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
