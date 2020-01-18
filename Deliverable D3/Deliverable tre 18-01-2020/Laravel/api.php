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

    Route::get('search','RicercaController@search')->middleware('auth'); // $nome=request('nome');

    Route::prefix('dipartimenti')->group(function() {
        Route::get('/','DipartimentiController@index');
        Route::get('/{dipartimento}','DipartimentiController@show');
        Route::get('/{dipartimento}/edifici','DipartimentiController@indexedifici');
        Route::get('/{dipartimento}/edifici/{edificio}','DipartimentiController@showedifici');
        Route::post('/','DipartimentiController@store');
        Route::delete('/{dipartimento}','DipartimentiController@destroy');
        Route::delete('/{dipartimento}/edifici/{edificio}','DipartimentiController@destroyedifici');
        Route::patch('/{dipartimento}','DipartimentiController@update');
        Route::patch('/{dipartimento/edifici/{edificio}','DipartimentiController@updateedifici');
    })->middleware('auth');

    Route::prefix('servizi')->group(function() {
        Route::get('/','SeriviziController@index');
        Route::get('/{servizio}','SeriviziController@show');
        Route::get('/{servizio}/poi','SeriviziController@indexpoi');
        Route::get('/{servizio}/poi/{poi}','SeriviziController@showpoi');
        Route::post('/','SeriviziController@store');
        Route::delete('/{servizio}','SeriviziController@destroy');
        Route::delete('/{servizio}/poi/{poi}','SeriviziController@destroypoi');
        Route::patch('/{servizio}','SeriviziController@update');
        Route::patch('/{servizio}/poi/{poi}','SeriviziController@updatepoi');
    })->middleware('auth');

    Route::prefix('edifici')->group(function() {
        Route::get('/','EdificiController@index');
        Route::get('/{edificio}','EdificiController@show');
        Route::get('/{edificio}/foto','EdificiController@indexfoto');
        Route::get('/{edificio}/foto/{foto}','EdificiController@showfoto');
        Route::get('/{edificio}/professori','EdificiController@indexprofessori');
        Route::get('/{edificio}/professori/{professore}','EdificiController@showprofessori');
        Route::post('/','EdificiController@store');
        Route::delete('/{edificio}','EdificiController@destroy');
        Route::delete('/{edificio}/foto/{foto}','EdificiController@destroyfoto');
        Route::delete('/{edificio}/professori/{professore}','EdificiController@destroyprofessori');
        Route::patch('/{edificio}','EdificiController@update');
        Route::patch('/{edificio}/professori/{professore}','EdificiController@updateprofessori');
    })->middleware('auth');

    Route::prefix('professori')->group(function() {
        Route::get('/','ProfessoriController@index');
        Route::get('/{professore}','ProfessoriController@show');
        Route::get('/{professore}/uffici','ProfessoriController@indexuffici');
        Route::get('/{professore}/uffici/{ufficio}','ProfessoriController@showuffici');
        Route::post('/','ProfessoriController@store');
        Route::delete('/{professore}','ProfessoriController@destroy');
        Route::delete('/{professore}/uffici/{ufficio}','ProfessoriController@destroyuffici');
        Route::patch('/{professore}','ProfessoriController@update');
        Route::patch('/{professore}/uffici/{ufficio}','ProfessoriController@updateuffici');
    })->middleware('auth');

    Route::prefix('uffici')->group(function() {
        Route::get('/','UfficiController@index');
        Route::get('/{ufficio}','UfficiController@show');
        Route::post('/','UfficiController@store');
        Route::delete('/{ufficio}','UfficiController@destroy');
        Route::patch('/{ufficio}','UfficiController@update');
    })->middleware('auth');

    Route::prefix('utenti')->group(function() {
        Route::get('/','UtentiController@index');
        Route::get('/{utente}','UtentiController@show');
        Route::post('/','UtentiController@store');
        Route::delete('/{utente}','UtentiController@destroy');
        Route::patch('/{utente}','UtentiController@update');
    })->middleware('auth');

    Route::prefix('università')->group(function() {
        Route::get('/','UniversitaController@index');
        Route::get('/{universita}','UniversitaController@show');
        Route::post('/','UniversitaController@store');
        Route::delete('/{universita}','UniversitaController@destroy');
        Route::patch('/{università}','UniversitaController@update');
    })->middleware('auth');

    Route::prefix('cdl')->group(function() {
        Route::get('/','CdLController@index');
        Route::get('/{cdl}','CdLController@show');
        Route::post('/','CdLController@store');
        Route::delete('/{cdl}','CdLController@destroy');
        Route::patch('/{cdl}','CdLController@update');
    })->middleware('auth');

    Route::prefix('foto')->group(function() {
        Route::get('/','FotoController@index');
        Route::get('/{foto}','FotoController@show');
        Route::post('/','FotoController@store');
        Route::delete('/{foto}','FotoController@destroy');
    })->middleware('auth');

    Route::prefix('poi')->group(function() {
        Route::get('/','POIController@index');
        Route::get('/{poi}','POIController@show');
        Route::post('/','POIController@store');
        Route::delete('/{poi}','POIController@destroy');
        Route::patch('/{poi}','POIController@update');
    })->middleware('auth');


