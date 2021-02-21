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
Route::get('/commands', function() {
    Artisan::call('storage:link');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('npm run watch');
    return 'DONE'; //Return anything
});
