<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    
});
Route::namespace('App\Http\Controllers\Api')->group(function () {
    Route::get('/allPatrimonios', 'ApiConfpatController@list');
    Route::get('selectPatrimonio/{id}', 'ApiConfpatController@select');
    Route::view('/create', 'CreateConference')->name('create');
    Route::post('/store', 'ApiConfpatController@store')->name('ConferenceStore');
    Route::get('/createConferences', 'ApiConfpatController@listdata');
    Route::get('/getConferences', 'ApiConfpatController@listConference')->name('Conferences');
    Route::get('/getUniqueConference/{id}', 'ApiConfpatController@UniqueConference');
});
