<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::view('/blog', 'blog')->name('blog.index');
Route::view('/blog/detail', 'article')->name('blog.show');

Route::view('/portfolio', 'portfolio')->name('portfolio.index');
Route::view('/portfolio/detail', 'portfolio-detail')->name('portfolio.show');

Route::view('/pricing', 'pricing')->name('pricing.index');

// About & Team Routes
Route::view('/about', 'about')->name('about.index');
Route::view('/team/detail', 'team.show')->name('team.show');

Route::view('/contact', 'contact')->name('contact.index');
