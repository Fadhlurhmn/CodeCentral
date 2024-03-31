<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/shop', function () {
    return view('index-1');
});

Route::get('/email', function () {
    return view('email');
});

Route::get('/typography', function () {
    return view('typography');
});

Route::get('/alert', function () {
    return view('alert');
});

Route::get('/buttons', function () {
    return view('buttons');
});

