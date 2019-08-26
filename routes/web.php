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
Route::get('/info/{id}', 'AddonsController@viewDetails')->name('addon_info');
Route::get('/index/{version}', 'AddonsController@createNFO');
Route::post('/addons/store', 'AddonsController@storeAddon');
Route::get('/addons/{id}/toggle_visibility', 'AddonsController@toggleVisibility')->name('addon_toggle_visibility');
Route::get('/addons/{id}/download', 'AddonsController@download');
Route::get('/addons/{id}/get_revisions', 'AddonsController@getRevisions');
Route::post('/addons/parse-nfo', 'AddonsController@MigrateFromNFO');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/manage', 'HomeController@manage')->name('dashboard_manage');