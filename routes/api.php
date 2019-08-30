<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------

*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// register new user
Route::post('register','AuthenticationController@register');

// login URL :create access token
Route::post('login','AuthenticationController@login');

// all categories
Route::get('all-categories','AllCategories@index');
Route::get('all-articles/{id}','AllCategories@articles');
Route::get('popular-articles', 'MostPopularArticles@popularArticles');
Route::get('popular-categories', 'MostPopularCategories@popularCategories');

// Check if the user is authenticated before accessing the following resources
// only the owner is allowed to edit,delete or create an article or category
Route::middleware(['auth:api','scopes:create,edit,delete'])->group(function () {
    Route::apiresource('categories', 'CategoryController');

    Route::apiresource('articles', 'ArticleController');



});
