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
    Route::get('/admin' , 'App\Http\Controllers\Homecontroller@admin');
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
