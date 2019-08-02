<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index')->name('dashboard');
	Route::get('/getExpensesData/{start_date}/{end_date}', 'HomeController@getExpensesData');
	Route::get('/getExpensesData', 'HomeController@getExpensesData');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

	Route::get('/not-allowed', 'HomeController@notAllowed');
	// Profile
	Route::group(['prefix' => 'profile'], function() {
		Route::get('/', 'ProfileController@index');
		Route::post('/edit-profile', 'ProfileController@postProfile');
		Route::post('/change-password', 'ProfileController@postChangePassword');
	});

	// Table fills
	Route::get('roles/getRoles', 'RoleController@getRoles');
	Route::get('users/getUsers', 'UserController@getUsers');
	Route::get('expense-categories/getCategories', 'CategoryController@getCategories');
	Route::get('expenses/getExpenses', 'ExpenseController@getExpenses');

	// RESOURCES
	Route::resource('roles', 'RoleController');
	Route::resource('users', 'UserController');
	Route::resource('expense-categories', 'CategoryController');
	Route::resource('expenses', 'ExpenseController');

});


