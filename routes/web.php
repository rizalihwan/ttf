<?php
date_default_timezone_set('Asia/Jakarta');
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/trash', 'HomeController@trash')->name('trash');
    // destroy
    Route::delete('/{logActivity}/destroy', 'HomeController@DestroyLogActivity')->name('log.destroy');
    Route::delete('/{id}/destroypermanent', 'HomeController@DestroyLogPermanent')->name('log.destroy.permanent');
    Route::post('/destroyall/permanent', 'HomeController@deleteAllTrash')->name('log.destroy.all');
    // restore
    Route::get('/{id}/restore', 'HomeController@restoreLogActivity')->name('log.restore');
    Route::get('/restore/all', 'HomeController@restoreAllTrash')->name('log.restore.all');

    Route::resource('book', 'BookController');
    Route::resource('category', 'CategoryController');
});