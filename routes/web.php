<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route for the control panel
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'CompanyController@showMore')->name('show_more');



// Route::get('/control_panel', 'HomeController@index')->name('home');
