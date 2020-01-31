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

    Route::prefix('departments')->group(function() {
        Route::get('/','DepartmentsController@index');
        Route::get('/{department}','DepartmentsController@show');
        Route::get('/{department}/buildings','DepartmentsController@indexbuildings');
        Route::get('/{department}/buildings/{building}','DepartmentsController@showbuilding');
        Route::get('/{department}/teachers','DepartmentsController@indexteachers');
        Route::get('/{department}/teachers/{teacher}','DepartmentsController@showteacher');
        Route::get('/{department}/teachers/{teacher}/offices','DepartmentsController@indexoffices');
        Route::get('/{department}/teachers/{teacher}/offices/{office}','DepartmentsController@showoffice');
        Route::get('/{department}/buildings/{building}/photos','DepartmentsController@indexphotos');
        Route::get('/{department}/buildings/{building}/photos/{photo}','DepartmentsController@showphoto');
        Route::post('/','DepartmentsController@store')->middleware('auth');
        Route::delete('/{department}','DepartmentsController@destroy')->middleware('auth');
        Route::delete('/{department}/buildings/{building}','DepartmentsController@destroybuilding')->middleware('auth');
        Route::patch('/{department}','DepartmentsController@update')->middleware('auth');
        Route::patch('/{department/buildings/{building}','DepartmentsController@updatebuilding')->middleware('auth');
    });

    Route::prefix('services')->group(function() {
        Route::get('/','ServicesController@index');
        Route::get('/{service}/poi','ServicesController@indexpoi');
        Route::get('/{service}/buildings','ServicesController@indexbuildings');
        Route::get('/{service}','ServicesController@show');
        Route::get('/{service}/poi/{poi}','ServicesController@showpoi');
        Route::get('/{service}/buildings/{building}','ServicesController@showbuilding');
        Route::post('/','ServicesController@store')->middleware('auth');
        Route::delete('/{service}','ServicesController@destroy')->middleware('auth');
        Route::delete('/{service}/markers/{marker}','ServicesController@destroymarker')->middleware('auth');
        Route::patch('/{service}','ServicesController@update')->middleware('auth');
        Route::patch('/{service}/markers/{marker}','ServicesController@updatemarker')->middleware('auth');
    });

    Route::prefix('buildings')->group(function() {
        Route::get('/','MarkersController@indexbuildings');
        Route::get('/{building}','MarkersController@showbuilding');
        Route::get('/{building}/photos','MarkersController@indexphotos');
        Route::get('/{building}/photos/{photo}','MarkersController@showphoto');
        Route::get('/{building}/departments','MarkersController@indexdepartments');
        Route::get('/{building}/departments/{department}','MarkersController@showdepartment');
        Route::get('/{building}/teachers','MarkersController@indexteachers');
        Route::get('/{building}/teachers/{teacher}','MarkersController@showteacher');
        Route::get('/{marker}/services','MarkersController@indexservices');
        Route::get('/{marker}/services/{service}','MarkersController@showservice');
        Route::post('/','MarkersController@store')->middleware('auth');
        Route::delete('/{marker}','MarkersController@destroy')->middleware('auth');
        Route::delete('/{building}/photos/{photo}','MarkersController@destroyphoto')->middleware('auth');
        Route::delete('/{building}/teachers/{teacher}','MarkersController@destroyteacher')->middleware('auth');
        Route::patch('/{marker}','MarkersController@update')->middleware('auth');
        Route::patch('/{building}/departments/{department}','MarkersController@updatedepartment')->middleware('auth');
        Route::patch('/{building}/teachers/{teacher}','MarkersController@updateteacher')->middleware('auth');
    });

    Route::prefix('teachers')->group(function() {
        Route::get('/','TeachersController@index');
        Route::get('/{teacher}','TeachersController@show');
        Route::get('/{teacher}/offices','TeachersController@indexoffices');
        Route::get('/{teacher}/offices/{office}','TeachersController@showoffice');
        Route::get('/{teacher}/departments','TeachersController@indexdepartment');
        Route::get('/{teacher}/departments/{department}','TeachersController@showdepartment');
        Route::get('/{teacher}/buildings','TeachersController@indexbuildings');
        Route::get('/{teacher}/buildings/{building}','TeachersController@showbuilding');
        Route::post('/','TeachersController@store')->middleware('auth');
        Route::delete('/{teacher}','TeachersController@destroy')->middleware('auth');
        Route::delete('/{teacher}/offices/{office}','TeachersController@destroyoffice')->middleware('auth');
        Route::patch('/{teacher}','TeachersController@update')->middleware('auth');
        Route::patch('/{teacher}/offices/{office}','TeachersController@updateoffice')->middleware('auth');
        Route::patch('/{teacher}/buildings/{building}','TeachersController@updatebuilding')->middleware('auth');
    });

    Route::prefix('offices')->group(function() {
        Route::get('/','OfficesController@index');
        Route::get('/{office}','OfficesController@show');
        Route::get('/{offices}/teachers','OfficesController@indexteachers');
        Route::get('/{office}/teachers/{teacher}','OfficesController@showteacher');
        Route::post('/','OfficesController@store')->middleware('auth');
        Route::delete('/{office}','OfficesController@destroy')->middleware('auth');
        Route::patch('/{office}','OfficesController@update')->middleware('auth');
        Route::patch('/{office}/teachers/{teacher}','OfficesController@updateteacher')->middleware('auth');
    });

    Route::prefix('users')->group(function() {
        Route::get('/','UsersController@index')->middleware('auth');
        Route::get('/{user}','UsersController@show')->middleware('auth');
        Route::post('/','UsersController@store')->middleware('auth');
        Route::delete('/{user}','UsersController@destroy')->middleware('auth');
        Route::patch('/{user}','UsersController@update')->middleware('auth');
    });

    Route::prefix('universities')->group(function() {
        Route::get('/','UniversitiesController@index');
        Route::get('/{university}','UniversitiesController@show');
        Route::post('/','UniversitiesController@store')->middleware('auth');
        Route::delete('/{university}','UniversitiesController@destroy')->middleware('auth');
        Route::patch('/{university}','UniversitiesController@update')->middleware('auth');
    });

    Route::prefix('degreecourses')->group(function() {
        Route::get('/','DegreecoursesController@index');
        Route::get('/{degreecourse}','DegreecoursesController@show');
        Route::post('/','DegreecoursesController@store')->middleware('auth');
        Route::delete('/{degreecourse}','DegreecoursesController@destroy')->middleware('auth');
        Route::patch('/{degreecourse}','DegreecoursesController@update')->middleware('auth');
    });

    Route::prefix('photos')->group(function() {
        Route::get('/','PhotosController@index')->middleware('auth');
        Route::get('/{photo}','PhotosController@show')->middleware('auth');
        Route::get('/{photo}/buildings','PhotosController@indexbuildings');
        Route::get('/{photo}/buildings/{buildings}','PhotosController@showbuilding');
        Route::post('/','PhotosController@store')->middleware('auth');
        Route::delete('/{photo}','PhotosController@destroy')->middleware('auth');
    });

    Route::prefix('poi')->group(function() {
        Route::get('/search','MarkersController@search');
        Route::get('/','MarkersController@indexpoi');
        Route::get('/{poi}','MarkersController@showpoi');
        Route::get('/{marker}/services','MarkersController@indexservices');
        Route::get('/{marker}/services/{service}','MarkersController@showservice');
        Route::post('/','MarkersController@store')->middleware('auth');
        Route::patch('/{poi}/services/{service}','MarkersController@updateservice')->middleware('auth');
        Route::patch('/{marker}','MarkersController@update')->middleware('auth');
        Route::delete('/{marker}','MarkersController@destroy')->middleware('auth');
    });

Route::prefix('markers')->group(function() {
    Route::get('/','MarkersController@index')->middleware('auth');
    Route::get('/{marker}','MarkersController@show')->middleware('auth');
    Route::post('/','MarkersController@store')->middleware('auth');
    Route::delete('/{marker}','MarkersController@destroy')->middleware('auth');
    Route::patch('/{marker}','MarkersController@update')->middleware('auth');
});


