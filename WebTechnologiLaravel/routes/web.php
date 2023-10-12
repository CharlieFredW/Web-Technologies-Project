<?php

use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Samples\SampleController;
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

//Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [LoginController::class, 'login'])->name('login');

//Signup routes
Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup.form');

Route::post('/signup', [SignupController::class, 'signup'])->name('signup');

//Logout routes
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

//Blog routes
Route::get('/blogs', function () {
    return view('blogPosts');
});

//Sample page routes
Route::get('/samplePage', function () {
    return view('samplePage');
});

//My page routes
Route::get('/my-page-creator', function () {
    return view('myPageCreator');
})->name('my-page-creator');


//Sample routes
//Used to display the sample upload form
Route::get('/createSample', [SampleController::class, 'create'])->name('samples.create');

//Used to upload samples to the database
Route::post('/storeSample', [SampleController::class, 'store'])->name('samples.store');
