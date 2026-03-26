<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/a-propos', function () {
    return view('propos');
})->name('about');

Route::get('/services', function () {
    return view('service');
})->name('services');
