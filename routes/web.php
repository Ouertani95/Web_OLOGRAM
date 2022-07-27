<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DisplayIssuesController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\IssuesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\LogsController;
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


// Route for get request of /main URI
Route::get('/', [JobsController::class,'index']);

// Route for form submission goes to JobsController class
Route::post('/', [JobsController::class,'run_queued_job']);

// Email testing route
Route::get('/test-mail', function() {
    Mail::raw('bonjour',function($message){
        $message->subject('Email de test 2')
                ->to(env("ADMIN_MAIL"));
    });
    return 'OK! Le mail a été envoyé !';
});

// Live feed route
Route::get('/live-feed/{id?}', [LogsController::class,'display_log']);

// file download route
Route::get('/download/{file_type?}/{id?}/{optional_input?}', [DownloadController::class,'download_files']);

// Results page route
Route::get('/results/{id?}/{file?}', function($id,$file) {
    
    return view("results")->with(["id"=>$id,"file"=>$file]);
});

// About page route
Route::view("/about","about");

// Issue page route
Route::view("/issue","issue");

// Issue form submission route
Route::post('/issue', [IssuesController::class,'sendIssue']);

// Contact page route
Route::view("/contact","contact");

// Contact form submission route
Route::post('/contact', [ContactsController::class,'sendContact']);

// Showing mails sent (used with mailhog)
Route::view("/mail","mail");

// Page route to display all issues reported in database
Route::get("/display-issues",[DisplayIssuesController::class,'DisplayIssues']);