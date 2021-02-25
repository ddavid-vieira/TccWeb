<?php

use Illuminate\Support\Facades\Route;

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


Route::namespace('App\Http\Controllers\ControllerSite')->group(function () {
    Route::get('/sala', 'ControllerSala@index');
    Route::get('/patrimonio', 'ControllerPatrimonio@index');
    Route::view('/import', 'Import')->name('Import');
    Route::post('/storePatrimonio', 'ControllerPatrimonio@store')->name('store');
    Route::view('/CreateUser', 'CreateUser')->name('CreateUser');
    Route::post('/storeUser', 'ControllerServidor@store')->name('Create');
    Route::view('/login', 'LoginUser')->name('LoginUser');
    Route::post('/auth', 'ControllerServidor@auth')->name('Auth');
    Route::any('/logout', 'ControllerServidor@Logout')->name('Logout');
    Route::get('/allSetor', 'ControllerSetor@all')->name('AllSetor');
    Route::post('StoreSetor', 'ControllerSetor@create')->name('StoreSetor');
    Route::view('/createSetor', 'CreateSetor')->name('CreateSetor');
    Route::post('StoreSalas', 'ControllerSala@create')->name('StoreSalas');
    Route::view('/ListSalasView', 'ListSalas')->name('ListSalas');
    Route::get('/listsalas', 'ControllerSala@list')->name('Salas');
    Route::post('/searchsalas', 'ControllerSala@search')->name('SearchSalas');
});
