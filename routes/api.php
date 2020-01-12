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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Notifikasi Controller
Route::post('/kirimnotif','ApiNotifikasiController@notif');
Route::get('/notif/{id}','ApiNotifikasiController@infonotif');
//ApiOrder Controller
Route::post('/pesan','ApiOrderController@pesan');
Route::get('/ticket/{id}/batal','ApiOrderController@batal');
Route::get('/listicket/{id}','ApiOrderController@orderlist');
Route::get('/infoticket/{id}','ApiOrderController@detailticket');
Route::get('/denda/{id}','ApiOrderController@denda');
//User Controller
Route::post('register','UserController@register');
Route::post('login','UserController@login');    
Route::post('editprofile','UserController@editprofile');
Route::get('profile/{id}','UserController@profile');
Route::post('gantipassword','UserController@gantipassword');
//Mobil Api Controller
Route::post('tambahmobil','MobilApiController@tambahmobil');
Route::get('mobil/{id}','MobilApiController@edit');
Route::post('mobil/update','MobilApiCOntroller@update');
Route::get('mobil/{id}/delete','MobilApiController@delete');

//Gedung Api Controller 
Route::get('gedung','GedungApiController@listgedung');
Route::get('gedung/{id}','GedungApiController@infogedung');
Route::get('gedung/search/{cari}','GedungApiController@search');
Route::get('lantai/{id}','GedungApiController@infolantai');
Route::get('slot/{id}','GedungApiController@infoslot');
//HistoryController
Route::get('/infohistoryticket/{id}','ApiHistoryController@infohistory');
Route::get('/historyorder/{id}','ApiHistoryController@history');
Route::get('/historysaldo/{id}','ApiHistoryController@historysaldo');
Route::get('infohistorysaldo/{id}','ApiHistoryController@infoshistorysaldo');