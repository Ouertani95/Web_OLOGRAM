<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route for get request of home page
Route::get('/', function () {
    // Mail::to('ouertani2006@gmail.com')->send(new \App\Mail\HelloMail());
    return view('welcome');
    });

// Route for get request of /main URI
Route::get('/main', [JobsController::class,'index']);

// Route for form submission goes to JobsController class
Route::post('/main', [JobsController::class,'run_job']);