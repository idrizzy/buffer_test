<?php
Use App\News;
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

Route::get('/news', 'NewsController@index');
Route::get('/news/{id}', 'NewsController@show');
Route::post('/news', 'NewsController@store');
Route::put('/news/{id}', 'NewsController@update');
Route::delete('/news/{id}', 'NewsController@delete');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
