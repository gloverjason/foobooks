<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Error example
Route::get('/example', function () {
    return view('abc');
});

// Directory route example
Route::get('/book/war-and-peace', function() {
    return 'You want to view the book war and peace...';
});

