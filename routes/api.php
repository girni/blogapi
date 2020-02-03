<?php

use Illuminate\Http\Request;
use BlogApi\Core\Enum\Role;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => '\BlogApi\Core\Http\Controllers\Api\Auth', 'prefix' => 'auth'], function () {
    Route::post('/login', [
        'uses' => 'LoginController@login',
        'as' => 'auth.login'
    ]);

    Route::post('/register', [
        'uses' => 'RegisterController@register',
        'as' => 'auth.register'
    ]);

    Route::post('/reset-password/email', [
        'uses' => 'ResetPasswordController@email',
        'as' => 'auth.reset_password.email'
    ]);

    Route::post('/reset-password/verify-token/{token}', [
        'uses' => 'ResetPasswordController@verifyToken',
        'as' => 'auth.reset_password.verifyToken'
    ]);

    Route::post('/reset-password/update/{token}', [
        'uses' => 'ResetPasswordController@update',
        'as' => 'auth.reset_password.reset'
    ]);
});

Route::group(['namespace' => '\BlogApi\Blog\Http\Controllers\Api'], function () {
    Route::get('/articles', [
        'uses' => 'ArticlesController@index',
        'as' => 'blog.articles.index'
    ]);

    Route::post('/articles', [
        'uses' => 'ArticlesController@create',
        'as' => 'blog.articles.store',
        'middleware' => ['auth:api', 'roles'],
        'roles' => [Role::ADMIN, Role::EDITOR]
    ]);

    Route::put('/articles/{article}', [
        'uses' => 'ArticlesController@update',
        'as' => 'blog.articles.update',
        'middleware' => ['auth:api', 'roles'],
        'roles' => [Role::ADMIN, Role::EDITOR]
    ]);

    Route::delete('/articles/{article}', [
        'uses' => 'ArticlesController@delete',
        'as' => 'blog.articles.delete',
        'middleware' => ['auth:api', 'roles'],
        'roles' => [Role::ADMIN, Role::EDITOR]
    ]);
});