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
Route::get('like/{id}', 'HomeController@saveLike')->name('like');
Route::get('dislike/{id}', 'HomeController@saveDislike')->name('dislike');



/*
|--------------------------------------------------------------------------
| About Routes
|--------------------------------------------------------------------------
*/
Route::get('/about', 'HomeController@about')->name('about');

// Route::get('/about', function () {
//     return view('others.about');
// });


/*
|--------------------------------------------------------------------------
| Contact Routes
|--------------------------------------------------------------------------
*/

Route::resource('contact', 'MainMenu\MessageController');
Route::get('/contact', 'HomeController@contact')->name('contact');


/*
|--------------------------------------------------------------------------
| Our Service Routes
|--------------------------------------------------------------------------
*/

Route::get('/services', 'HomeController@services')->name('services');


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
Route::get('{any}', 'Other\WelcomeController@index')->where("any", ".*");



/*
|--------------------------------------------------------------------------
| Commands Routes
|--------------------------------------------------------------------------
*/
Route::get('commands', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return back()->with('success', 'Commands executed successfully!');
});


