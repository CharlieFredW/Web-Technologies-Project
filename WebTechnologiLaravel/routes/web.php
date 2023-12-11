<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\MyPageController;
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

Route::post('/sort-samples-downloads', [SampleController::class, 'sortSamplesDownloads']);

Route::post('/sort-samples-bpm', [SampleController::class, 'sortSamplesBPM']);

Route::post('/sort-samples-key', [SampleController::class, 'sortSamplesKey']);

Route::post('/sort-samples-genre', [SampleController::class, 'sortSamplesGenre']);

Route::post('/sort-samples-date', [SampleController::class, 'sortSamplesDate']);

Route::post('/sort-samples-instrument', [SampleController::class, 'sortSamplesInstrument']);


//My page routes

Route::get('/my-page-creator', [MyPageController::class, 'showMyPage'])->name('my-page-creator')->middleware('auth');

//Edit my page
Route::get('/edit-profile-page', [UserController::class, 'showProfile'])->name('edit-profile-page')->middleware('auth');
Route::put('/update-username', [UserController::class, 'updateUsername'])->name('update.username')->middleware('auth');
Route::put('/update-password', [UserController::class, 'updatePassword'])->name('update.password')->middleware('auth');


//Sample routes
//Used to display the sample upload form
Route::get('/samples/create', [SampleController::class, 'create'])->name('samples.create');

Route::delete('/samples/{sample}', [SampleController::class, 'destroy'])->name('samples.destroy');

Route::get('/samples/{sample}/edit', [SampleController::class, 'edit'])->name('samples.edit');

Route::put('/samples/{sample}', [SampleController::class, 'update'])->name('samples.update');

Route::post('/update-total-downloads/{sample}', [SampleController::class, 'updateTotalDownloads']);

//Used to upload samples to the database
Route::post('/samples/store', [SampleController::class, 'store'])->name('samples.store');

// Blog routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index'); // Show blog posts

// Route for showing the form to create a new blog post
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');

Route::get('/blogs', [BlogController::class, 'index']);

Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store');

Route::delete('/blogs/{blog}', [BlogController::class, 'delete'])->name('blog.delete');

Route::post('/rate-sample', [SampleController::class, 'rateSample'])->name('sample.rate');




