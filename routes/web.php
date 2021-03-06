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
Route::get('/createcompany', 'CompanyController@create')->name('create.company');
// Route for storage company, whit ajax call
Route::post('/storecompany', 'CompanyController@store')->name('store.company');
// Route for edit company, whit ajax call
Route::get('/company/edit/{id}', 'AjaxCompanyController@edit')->name('edit.company');
// Route for update company, whit ajax call
Route::post('/company/update/{id}', 'CompanyController@update')->name('update.company');
// Route for delete company, whit ajax call
Route::get('/company/delete/{id}', 'CompanyController@destroy')->name('delete.company');
// Route for ajax call companies list
Route::get('/companies', 'CompanyController@showMore')->name('show_more_comp');
// Route for show more related employees of company
Route::get('/company/relatedemp', 'CompanyController@show')->name('show_more_related_employees');
// Route for ajax call last result list
Route::get('/lastcompany', 'CompanyController@lastResult')->name('last.result');
// Route for ajax call employee list
Route::get('/employees', 'EmployeeController@showMore')->name('show_more_empl');
// Route for delete Employee, whit ajax call
Route::get('/employee/delete/{id}', 'EmployeeController@destroy')->name('delete.employee');
// Route for edit Employee, whit ajax call
Route::get('/employee/edit/{id}', 'EmployeeController@edit')->name('edit.employee');
// Route for update Employee, whit ajax call
Route::post('/employee/update/{id}', 'EmployeeController@update')->name('update.employee');
// Route for live search_company
Route::get('/search/company', 'AjaxCompanyController@liveSearch')->name('search.company');
// Route for live search_company
Route::get('/search/employee', 'AjaxEmployeeController@liveSearch')->name('search.employee');

// Route for Ajax refreshcompany item after update
Route::get('/refresh/company/{id}', 'AjaxCompanyController@refreshItem')->name('refresh.company');

// Route for Ajax refreshcompany item after update
Route::get('/refresh/employee/{id}', 'AjaxEmployeeController@refreshItem')->name('refresh.employee');

// Route for uploader image
Route::post('/form/{id}', 'LogoController@show')->name('index.upload');
Route::post('/upload/{id}', 'LogoController@submit')->name('example.upload');
Route::post('/ajax_remove_file/{id}', 'LogoController@removeFile');

Route::post('/companyupdate/prova/{id}', 'ProveController@update')->name('prova.update')->middleware('auth');


// Route::get('/control_panel', 'HomeController@index')->name('home');
