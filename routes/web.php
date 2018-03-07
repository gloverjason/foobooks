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


Route::get('/', 'PageController@welcome');

Route::get('/about', 'PageController@about');

// Error example
/*Route::get('/example', function () {
    return view('abc');
});*/

// Directory route example
/*Route::get('/book/war-and-peace', function() {
    return 'You want to view the book war and peace...';
});*/

/*Route::get('/books', function () {
    return 'Here are all the books in the library';
});*/
// Above is changed to
Route::get('/books', 'BookController@index');
// because of controller

Route::get('/books/{title}', 'BookController@show');

Route::get('/contact', 'PageController@contact');

// Root URL loads homepage (p3)
// Route::get('/', 'TriviaController@index');

// Route::get('/check-answer', 'TriviaController@checkAnswer');


