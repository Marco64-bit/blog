<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index']);

// 1- define a new route so the user can access it through the browser
// 2- define a controller that renders a view
// 3- define a view that contains a list of posts
// 4- remove any static HTML data from the view
