<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Insights Routes
|--------------------------------------------------------------------------
|
*/
Route::get('insights', 'MainMenu\InsightController@index');

/*
|--------------------------------------------------------------------------
| Posts Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('posts', 'MainMenu\PostController');
Route::post('description-editor-images', 'MainMenu\PostController@postDescriptionEditorImages');


/*
|--------------------------------------------------------------------------
| Information Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('information', 'MainMenu\InformationController');


/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('users', 'MainMenu\UserController');

/*
|--------------------------------------------------------------------------
| User Type Routes
|--------------------------------------------------------------------------
|
*/
Route::get('user_types', 'Other\UserTypeController@index');

/*
|--------------------------------------------------------------------------
| Post Category Routes
|--------------------------------------------------------------------------
|
*/
Route::get('post_categories', 'Other\PostCategoryController@index');

/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('posts', 'MainMenu\PostController');


/*
|--------------------------------------------------------------------------
| Feedbacks Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('feedbacks', 'MainMenu\FeedbackController');



/*
|--------------------------------------------------------------------------
| Visitors Routes
|--------------------------------------------------------------------------
|
*/
Route::post('save-visitor', 'MainMenu\VisitorController@saveVisitor');





