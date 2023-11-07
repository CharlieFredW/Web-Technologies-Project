<?php

use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\Samples\SampleController;
use App\Http\Controllers\BlogController;
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

Route::get('/', [HomePageController::class, 'showHomepage']);

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
    return view('blog-posts');
    });

//Sample page routes

Route::get('/sample-page', [SampleController::class, 'showSamplesPage']);

Route::post('/update-total-downloads/{sample}', [SampleController::class, 'updateTotalDownloads']);

//My page routes

Route::get('/my-page-creator', [MyPageController::class, 'showMySamples'])->name('my-page-creator')->middleware('auth');

//Sample routes
//Used to display the sample upload form
Route::get('/create-sample', [SampleController::class, 'create'])->name('samples.create');

//Used to upload samples to the database
Route::post('/store-sample', [SampleController::class, 'store'])->name('samples.store');




// Blog routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index'); // Show blog posts

// Route for showing the form to create a new blog post
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');

Route::get('/blogs', [BlogController::class, 'index']);

Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store');

Route::delete('/blogs/{blog}', [BlogController::class, 'delete'])->name('blog.delete');




