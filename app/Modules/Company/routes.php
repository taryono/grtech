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
Route::group(['prefix' => 'company', 'namespace' => 'App\Modules\Company\Controllers', 'middleware' => ['web','admin']], function () {
    Route::get('/', ['as' => 'company.index', 'uses' => 'CompanyController@index']);
    Route::get('/create', ['as' => 'company.create', 'uses' => 'CompanyController@create']);
    Route::post('/store', ['as' => 'company.store', 'uses' => 'CompanyController@store']);
    Route::get('/edit/{id}', ['as' => 'company.edit', 'uses' => 'CompanyController@edit']);
    Route::put('/update/{id}', ['as' => 'company.update', 'uses' => 'CompanyController@update']);
    Route::delete('/destroy/{id}', ['as' => 'company.destroy', 'uses' => 'CompanyController@destroy']);
});