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
    Route::get('/getUniqueReport/{Idconferencia}/{IdRegisterConference}/{Matricula}', 'ControllerConferencia@UniqueReport')->name('UniqueReport');
    Route::get('/patrimonio', 'ControllerPatrimonio@index');
    Route::any('/import', 'ControllerPatrimonio@route')->name('Import');
    Route::any('/storePatrimonio', 'ControllerPatrimonio@store')->name('store');
    Route::post('/createUniqueQrcode', 'ControllerPatrimonio@createUniqPcueQrcode')->name('CreateUniqueQrCode');
    Route::view('/CreateUser', 'CreateUser')->name('CreateUser');
    Route::post('/storeUser', 'ControllerServidor@store')->name('Create');
    Route::view('/', 'LoginUser')->name('LoginUser');
    Route::post('/auth', 'ControllerServidor@auth')->name('Auth');
    Route::any('/logout', 'ControllerServidor@Logout')->name('Logout');
    Route::get('/allSetor', 'ControllerSetor@all')->name('AllSetor');
    Route::post('StoreSetor', 'ControllerSetor@create')->name('StoreSetor');
    Route::view('/createSetor', 'CreateSetor')->name('CreateSetor');
    Route::post('StoreSalas', 'ControllerSala@create')->name('StoreSalas');
    Route::view('/ListSalasView', 'ListSalas')->name('ListSalas');
    Route::get('/listsalas', 'ControllerSala@list')->name('Salas');
    Route::post('/searchsalas', 'ControllerSala@search')->name('SearchSalas');
    Route::any('/deletePatrimonios/{id}', 'ControllerPatrimonio@deletePatrimonios')->name('DeletePatrimonios');
    Route::any('/deleteConferencias/{id}', 'ControllerConferencia@deleteConferencias')->name('DeleteConferencias');
    Route::view('importUniqueQrCode', 'ImportUniqueQrCode')->name('ImportUniqueQrCode');
    Route::get('listconferencesweb', 'ControllerConferencia@listconferences')->name('ListConferences');
    Route::get('/getUniqueConference/{sala}', 'ControllerConferencia@getUniqueConferencia')->name('GetUniqueConference');
    Route::view('GetUniqueConferencia', 'GetUniqueConferencia')->name('GetUniqueConferencia');
    Route::view('Import', 'Import')->name('Import');
    Route::any('/deleteSetor/{id}', 'ControllerSetor@deleteSetor');
    Route::any('/deleteServidor/{id}', 'ControllerServidor@deleteServidor');
    Route::any('/deleteSala/{id}', 'ControllerSala@deleteSala');
});
