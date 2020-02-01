<?php

use Boostcsgo\Core\Enum\UserRole;

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

// Authentication Routes...

Route::get('/', function () {
    return view('welcome');
});
//
//Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => [UserRole::ADMIN]], function () {
//    Route::group(['namespace' => '\Boostcsgo\User\Http\Controllers', 'prefix' => 'users'], function () {
//        Route::get('/', ['uses' => 'UsersController@index', 'as' => 'admin.users.index']);
//        /** rates */
//        Route::get('/rates/edit/{user}/{slug}', ['uses' => 'UserRatesController@edit', 'as' => 'admin.user_rates.edit']);
//        Route::put('/rates/update/{user}/{gameType}', [ 'uses' => 'UserRatesController@update', 'as' => 'admin.user_rates.update']);
//        Route::delete('/rates/delete/{user}/{gameType}', [ 'uses' => 'UserRatesController@delete', 'as' => 'admin.user_rates.delete']);
//        /** endrates */
//        Route::get('/edit/{user}', ['uses' => 'UsersController@edit', 'as' => 'admin.users.edit']);
//        Route::put('/update/{user}', ['uses' => 'UsersController@update', 'as' => 'admin.users.update']);
//    });
//
//    Route::group(['namespace' => '\Boostcsgo\Game\Http\Controllers', 'prefix' => 'games'], function () {
//        Route::get('/', ['uses' => 'GamesController@index', 'as' => 'admin.games.index']);
//        Route::get('/create', ['uses' => 'GamesController@create', 'as' => 'admin.games.create']);
//        Route::post('/store', ['uses' => 'GamesController@store', 'as' => 'admin.games.store']);
//        Route::get('/edit/{game}', ['uses' => 'GamesController@edit', 'as' => 'admin.games.edit']);
//        Route::put('/update/{game}', ['uses' => 'GamesController@update', 'as' => 'admin.games.update']);
//        Route::delete('/delete/{game}', ['uses' => 'GamesController@delete', 'as' => 'admin.games.delete']);
//    });
//
//    Route::group(['namespace' => '\Boostcsgo\Game\Http\Controllers', 'prefix' => 'game-types'], function () {
//        Route::get('/create/{game}', ['as' => 'admin.game_types.create', 'uses' => 'GameTypesController@create']);
//        Route::post('/store/{game}', ['as' => 'admin.game_types.store', 'uses' => 'GameTypesController@store']);
//        Route::get('/show/{gameType}', ['as' => 'admin.game_types.show', 'uses' => 'GameTypesController@show']);
//        Route::get('/edit/{gameType}', ['as' => 'admin.game_types.edit', 'uses' => 'GameTypesController@edit']);
//        Route::put('/update/{gameType}', ['as' => 'admin.game_types.update', 'uses' => 'GameTypesController@update']);
//        Route::delete('/delete/{gameType}', ['as' => 'admin.game_types.delete', 'uses' => 'GameTypesController@delete']);
//    });
//
//    Route::group(['namespace' => '\Boostcsgo\Game\Http\Controllers', 'prefix' => 'game-type-fields'], function () {
//        Route::get('/create/{gameType}', ['as' => 'admin.game_type_fields.create', 'uses' => 'GameTypeFieldsController@create']);
//        Route::post('/store/{gameType}', ['as' => 'admin.game_type_fields.store', 'uses' => 'GameTypeFieldsController@store']);
//        Route::get('/edit/{gameTypeField}', ['as' => 'admin.game_type_fields.edit', 'uses' => 'GameTypeFieldsController@edit']);
//        Route::put('/update/{gameTypeField}', ['as' => 'admin.game_type_fields.update', 'uses' => 'GameTypeFieldsController@update']);
//        Route::delete('/delete/{gameTypeField}', ['as' => 'admin.game_type_fields.delete', 'uses' => 'GameTypeFieldsController@delete']);
//    });
//
//    Route::group(['namespace' => '\Boostcsgo\Order\Http\Controllers', 'prefix' => 'orders'], function () {
//        Route::get('/', ['as' => 'admin.orders.index', 'uses' => 'OrdersController@index']);
//        Route::post('/change-time-range', ['as' => 'admin.orders.change_time_range', 'uses' => 'OrdersController@changeTimeRange']);
//
//    });
//});


// Companies
//Route::group(['namespace' => '\Fakturify\Companies\Http\Controllers', 'prefix' => 'companies'], function () {
//    Route::get('/', [
//        'uses' => 'CompaniesController@index',
//        'as' => 'companies.index'
//    ]);
//
//    Route::get('/create', [
//        'uses' => 'CompaniesController@create',
//        'as' => 'companies.create'
//    ]);
//
//    Route::post('/store', [
//        'uses' => 'CompaniesController@store',
//        'as' => 'companies.store'
//    ]);
//
//    Route::get('/edit/{company}', [
//        'uses' => 'CompaniesController@edit',
//        'as' => 'companies.edit'
//    ]);
//
//    Route::put('/update/{company}', [
//        'uses' => 'CompaniesController@update',
//        'as' => 'companies.update'
//    ]);
//});
