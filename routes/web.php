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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard', 'middleware'=>['web', 'auth'], 'namespace' => 'App\Http\Controllers'], function() {
    Route::get('/', 'HomeController@dashboard')->name('dashboard');
    Route::get('/analysis', 'HomeController@analysis')->name('analysis');
    Route::post('/upload', 'HomeController@uploadImage')->name('upload');
    Route::get('/logout', 'HomeController@logout')->name('logout');
});

Route::get('auth/google', 'App\Http\Controllers\GoogleController@redirectToGoogle')->name('google');
Route::get('auth/google/callback', 'App\Http\Controllers\GoogleController@handleGoogleCallback');
