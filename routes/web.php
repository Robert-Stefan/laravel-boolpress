<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



// ROTTE X AUTENTICAZIONE
Auth::routes();

//Route::get('/admin', 'HomeController@index')->name('home');

// ROUTE ADMIN
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin')
    ->group(function() {

        // ROUTE HOME ADMIN
        Route::get('/', 'HomeController@index')->name('home');

        // ROUTE RESOURCE POSTS
        Route::resource('/posts', 'PostController');
    });

//FRONT OFFICE
Route::get('{any?}', function () {
    return view('guest.home');
})->where("any", ".*");
