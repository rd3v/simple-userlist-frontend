<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect('/home');
});

Route::any('{slug}', function() {
    return view('home');
})->where('slug', '.*');