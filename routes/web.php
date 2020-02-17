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

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::middleware(['auth'])->group(
    function () {

        Route::resource('transits', 'TransitsController')->except('create', 'edit', 'show');
        Route::resource('appointments', 'AppointmentsController')->except('create', 'edit', 'show');
        Route::resource('employees', 'EmployeesController')->except('create', 'edit', 'show');
        Route::resource('transit-types', 'TransitTypesController')->except('create', 'edit', 'show');
        Route::resource('locations', 'LocationsController')->except('create', 'edit', 'show');
        
    }
);
