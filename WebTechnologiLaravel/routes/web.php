<?php

use App\Http\Controllers\Auth\SignupController;
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
    return view('homepage');
});

Route::get('/login', function () {
    return view('loginPage');
});

Route::get('/signup', [SignupController::class, 'show'])->name('signup.form');

Route::post('/signup', [SignupController::class, 'signup'])->name('signup');

Route::get('/blogs', function () {
    return view('blogPosts');
});

Route::get('/my-page-creator', function () {
    return view('myPageCreator');
})->name('my-page-creator');

Route::get('/my-page-guest', function () {
    return view('myPageGuest');
})->name('my-page-guest');
