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
    Route::get('/bills', 'HomeController@bills')->name('bills');
    Route::get('/bill/add', 'HomeController@newBill')->name('bill.new');
    Route::post('/bill/add', 'HomeController@createBill')->name('bill.create');
    Route::get('/bill/{id}/edit', 'HomeController@editBill')->name('bill.edit');
    Route::post('/bill/{id}/update', 'HomeController@updateBill')->name('bill.update');
    Route::post('/bill/{id}/detele', 'HomeController@deleteBill')->name('bill.delete');
    Route::get('/analysis', 'HomeController@analysis')->name('analysis');
    Route::post('/upload', 'HomeController@uploadImage')->name('upload');
    Route::get('/logout', 'HomeController@logout')->name('logout');
});

Route::get('auth/google', 'App\Http\Controllers\GoogleController@redirectToGoogle')->name('google');
Route::get('auth/google/callback', 'App\Http\Controllers\GoogleController@handleGoogleCallback');
