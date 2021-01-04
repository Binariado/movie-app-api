<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
  //'middleware' => 'api',
  'prefix' => 'auth',
], function () {
  Route::post('register', 'App\Http\Controllers\AuthController@register');
  Route::post('login', 'App\Http\Controllers\AuthController@login');
  Route::group([
    'middleware' => ['jwt.verify'],
  ], function () {
    Route::get('me', 'App\Http\Controllers\AuthController@me');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
  });
});

Route::group([
  //'middleware' => ['jwt.verify'],
  'prefix' => 'menu',
], function () {
    Route::get('list-menu', 'App\Http\Controllers\MenuController@listMenu');
});

Route::group(['prefix' => 'movies'], function () {
    Route::resource('/', 'App\Http\Controllers\MoviesController');
});
