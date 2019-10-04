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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/admin/categoery/get-category', 'CategoryController@index');
Route::get('/admin/categoery/edit', 'CategoryController@edit');
Route::post('/admin/categoery/update', 'CategoryController@update');
Route::get('/admin/categoery/create', function()
{
    return view('admin.cateogry.create');
});
Route::post('/admin/categoery/store', 'CategoryController@store');
Route::get('/admin/categoery/delete', 'CategoryController@delete');

Route::get('/user/profile/view', 'UserController@view_profile');
Route::post('/admin/user/update_details', 'UserController@update_profile');

Route::get('/admin/expenses/get-expense', 'ExpenseController@index');
Route::get('/admin/expenses/edit', 'ExpenseController@edit');
Route::post('/admin/expenses/update', 'ExpenseController@update');
Route::get('/admin/expenses/create', 'ExpenseController@create');
Route::get('/admin/expenses/delete', 'ExpenseController@delete');
Route::post('/admin/expenses/store', 'ExpenseController@store');
Route::get('/admin/expenses/validate', 'ExpenseController@ValidateExpenses');


Route::get('/admin/expenses/limitation','ExpenseController@expensesLimitation');
Route::get('/admin/expenses/limitation/add','ExpenseController@addLimitation');
Route::post('/admin/expenses/limitation/store','ExpenseController@storeLimitation');
Route::get('/admin/expenses/limitation/edit','ExpenseController@editLimitation');
Route::post('/admin/expenses/limitation/{id}/update','ExpenseController@updateLimitation');
Route::get('/admin/expenses/limitation/delete','ExpenseController@deleteLimitation');

Route::get('/admin/expenses/analytics','ExpenseController@Analytics');





