<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/addons', 'AddonsController@showAll');
Route::get('/addons/add', 'AddonsController@add');
Route::get('/addons/migrate', 'AddonsController@migrate');
Route::get('/info/{id}', 'AddonsController@viewDetails');
Route::post('/addons/store', 'AddonsController@storeAddon');
Route::post('/addons/parse-nfo', 'AddonsController@MigrateFromNFO');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
