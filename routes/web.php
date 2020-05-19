<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (auth()->user()) {
        return redirect('/home');
    }
    return view('welcome');
});

Route::get('/home', 'TaskController@list');
Route::post('/tasks', 'TaskController@create');
Route::put('/tasks/{task}', 'TaskController@edit');
Route::delete('/tasks/{task}', 'TaskController@delete');

Route::post('/categories', 'CategoryController@create');
Route::put('/categories/{category}', 'CategoryController@edit');
Route::delete('/categories/{category}', 'CategoryController@delete');

Auth::routes(['verify' => true]);
Route::get('/send-mail', function () {
    $details = [
        'title' => 'Email Confirmation',
        'body' => 'Please Confirm your email adresse for Tasked.com'
    ];
    Mail::to('oussmiled@gmail.com')->send(new \App\Mail\MyMailer($details));
    echo 'email sent!';
});
