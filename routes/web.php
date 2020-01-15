<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route for the control panel
Route::get('/home', 'HomeController@index')->name('home');
// Route for ajax call companies list
Route::get('/companies', 'CompanyController@showMore')->name('show_more_comp');
// Route for ajax call employee list
Route::get('/employees', 'EmployeeController@showMore')->name('show_more_empl');


// Route::get('/control_panel', 'HomeController@index')->name('home');
