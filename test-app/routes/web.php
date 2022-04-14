<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

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

Route::get('/', function () {
    // Mail::to('ouertani2006@gmail.com')->send(new \App\Mail\HelloMail());
    return view('welcome');
    });

Route::get('/main',function(){
    return view('main');
    });

ROUTE::post('/main',function(){
    Job::create([
        'email' => request('email'),
        'gtf' => request('gtf'),
        'bed' => request('bed')
    ]);
    // redirect to main page and show success message (linked to @if @endif in view)
    return redirect('/main')->with('success', 'Job is running !');
    // return var_dump(request('gtf'));
});