<?php

namespace App\Http\Controllers;

// Common class within controllers
use Illuminate\Http\Request;

// 'extends Controller = Parent class of controller'
class BookController extends Controller
{
    // each method (action) will be connect to a route
    public function index() {
        return 'Here are all the books in the library';
    }

    public function show($title) {
        return 'You are viewing the book: ' . $title;
    }
}
