<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// ใส่เครื่องหมาย comment 3 บรรทัดไปก่อน

Route::middleware(['cors','api'])->group(function () {
    Route::post('post', 'PostController@create');
    Route::get('post', 'PostController@read');
    Route::put('post/{id}', 'PostController@update');
    Route::delete('post/{id}', 'PostController@delete');
    
    Route::post('comment', 'CommentController@create');
    Route::put('comment/{id}', 'CommentController@update');
    Route::delete('comment/{id}', 'CommentController@delete');
});