<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', ['as' => 'home', 'uses' => 'indexController@index']);
route::get('del', 'sessionController@deleteSessionData');
Route::get('par-mums', 'indexController@about');
//partlist routes
Route::get('procesori{name?}', ['as' => 'procesori', 'uses' => 'partListController@showAllCpu']);
Route::get('operativa-atmina', 'partListController@showAllMemory');
route::get('skanas-kartes', 'partListController@showAllSoundCard');
Route::get('procesora-dzesetaji', 'partListController@showAllCpuCoolers');
Route::get('bezvadu-tikla-kartes', 'partListController@showAllWirelessCard');
Route::get('barosanas-bloki', 'partListController@showAllPsu');
Route::get('video-kartes', 'partListController@showAllGpu');
Route::get('atminas', 'partListController@showAllStorage');
Route::get('tikla-kartes', 'partListController@ShowAllWiredCard');
route::get('korpusi', 'partListController@showAllCase');
route::get('matesplates', 'partListController@showAllMobo');
route::get('diskdzini', 'partListController@showAllOpticalDrive');
route::get('korpusa-ventilatori', 'partListController@showAllCaseFan');

//store-delete routes
Route::post('sessions/{name}/{value}', ['as' => 'session.store', 'uses' => 'sessionController@storeSessionData']);
Route::get('delete/{name}/{value}', ['as' => 'session.delete', 'uses' => 'sessionController@deleteSessionValue']);

Route::get('saliec-pats', ['as' => 'compatibilityCheck', 'uses' => 'compatibilityController@compatibilityCheck']);

//part routes
route::get('matesplate-{slug}', 'partController@showMobo');
route::get('procesors-{slug}', 'partController@showCpu');
route::get('operativa-atmina-{slug}', 'partController@showMemory');
route::get('procesora-dzesetajs-{slug}', 'partController@showCpuCooler');
route::get('atmina-{slug}', 'partController@showStorage');
route::get('skanas-karte-{slug}', 'partController@showSoundCard');
route::get('tikla-karte-{slug}', 'partController@showWiredCard');
route::get('bezvadu-tikla-karte-{slug}', 'partController@showWirelessCard');
route::get('korpuss-{slug}', 'partController@showCase');
route::get('video-karte-{slug}', 'partController@showGpu');
route::get('barosanas-bloks-{slug}', 'partController@showPsu');
route::get('diskdzinis-{slug}', 'partController@showOpticalDrive');
route::get('korpusa-ventilators-{slug}', 'partController@showCaseFan');
