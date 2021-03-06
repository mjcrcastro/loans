<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('dashboard.index');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::resource('contacts', 'ContactsController');
    Route::resource('countries', 'CountriesController');
    Route::resource('departments', 'DepartmentsController');
    Route::resource('municipalities', 'MunicipalitiesController');
    Route::resource('occupations', 'OccupationsController');
    Route::resource('loan_categories','LoanCategoriesController');
    Route::resource('funds','FundsController');
    Route::resource('loan_statuses','LoanStatusesController');
    Route::resource('loans','LoansController');
    Route::get('jpayments', array('uses' => 'serverFunctions@payments'));
});
