<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route for the control panel
Route::get('/home', 'HomeController@index')->name('home');
// Route for show cpompany detail and Employees list
Route::get('/company/{id}', 'CompanyController@show')->name('show.company');
// Route for create form company, whit ajax call
Route::get('/createcompany', 'CompanyController@create')->name('create.company')->middleware('auth');
// Route for storage company, whit ajax call
Route::post('/storecompany', 'CompanyController@store')->name('store.company')->middleware('auth');
// Route for delete company, whit ajax call
Route::get('/company/delete/{id}', 'CompanyController@destroy')->name('delete.company')->middleware('auth');
// Route for ajax call companies list
Route::get('/companies', 'CompanyController@showMore')->name('show_more_comp');
// Route for ajax call last result list
Route::get('/lastcompany', 'CompanyController@lastResult')->name('last.result');
// Route for ajax call employee list
Route::get('/employees', 'EmployeeController@showMore')->name('show_more_empl');
// Route for uploader image
Route::post('/form/{id}', 'LogoController@show')->name('index.upload');
Route::post('/upload/{id}', 'LogoController@submit')->name('example.upload');
Route::post('/ajax_remove_file/{id}', 'LogoController@removeFile');


// Route::get('/control_panel', 'HomeController@index')->name('home');
