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
Route::group(['prefix' => 'employee', 'namespace' => 'App\Modules\Employee\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'employee.index', 'uses' => 'EmployeeController@index']);
    Route::get('/create', ['as' => 'employee.create', 'uses' => 'EmployeeController@create']);
    Route::get('/show_company/{id}', ['as' => 'employee.show_company', 'uses' => 'EmployeeController@show_company']);    
    Route::post('/store', ['as' => 'employee.store', 'uses' => 'EmployeeController@store']);
    Route::get('/edit/{id}', ['as' => 'employee.edit', 'uses' => 'EmployeeController@edit']);
    Route::put('/update/{id}', ['as' => 'employee.update', 'uses' => 'EmployeeController@update']);
    Route::delete('/delete/{id}', ['as' => 'employee.destroy', 'uses' => 'EmployeeController@destroy']);
});