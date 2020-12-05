<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect("/home");
});

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
*/
Route::resource('home', 'HomeController');



/*
|--------------------------------------------------------------------------
| About Routes
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return view('others.about');
});


/*
|--------------------------------------------------------------------------
| Contact Routes
|--------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| Contact Routes
|--------------------------------------------------------------------------
*/

Route::resource('contact', 'MainMenu\MessageController');

/*
|--------------------------------------------------------------------------
| Our Service Routes
|--------------------------------------------------------------------------
*/

Route::get('/services', function () {
    return view('others.services');
});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Auth::routes();


/*
|--------------------------------------------------------------------------
| Welcome Routes
|--------------------------------------------------------------------------
*/
Route::get('/welcome', 'Other\WelcomeController@index')->name('welcome');


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', 'MainMenu\DashboardController@index')->name('dashboard');


/*
|--------------------------------------------------------------------------
| Prevent Laravel Route Errors
|--------------------------------------------------------------------------
*/
Route::get('{any}', 'HomeController@index')->where("any", ".*");
