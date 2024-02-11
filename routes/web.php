<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'UsersController@index')->name('home');

Route::resource('user','UsersController');
Route::softDeletes('user','UsersController');

