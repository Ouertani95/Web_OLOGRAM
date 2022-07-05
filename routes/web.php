<?php

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
                ->to('ouertani2006@gmail.com');
    });
    return 'OK! Le mail a été envoyé !';
});

Route::get('/live-feed/{id?}', [LogsController::class,'display_log']);

Route::view("/test","test");

Route::get('/download/{species?}', [DownloadController::class,'download_files']);

Route::get('/results/{id?}/{file?}', function($id,$file) {
    
    return view("results")->with(["id"=>$id,"file"=>$file]);
});

Route::view("/about","about");

Route::view("/issue","issue");

Route::post('/', [IssuesController::class,'sendIssue']);

Route::view("/contact","contact");