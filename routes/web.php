<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Mail;

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
Route::post('/main', [JobsController::class,'run_queued_job']);

Route::get('/test-mail', function() {
    Mail::raw('bonjour',function($message){
        $message->subject('Email de test 2')
                ->to('ouertani2006@gmail.com');
    });
    return 'OK! Le mail a été envoyé !';
});

Route::get('/results',function (){
    return view('results.web_ologram');
});

Route::get('/results/{id?}',function($id){
    $results="results.".$id;
    return view("$results");
});