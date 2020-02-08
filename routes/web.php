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

Route::get('/', 'Client\HomeController@index')->name('homepage');
Route::get('/home' , 'HomeController@index')->name('home');
Route::post('/result', 'Client\HomeController@search')->name('search');
// Home Page Admin
Route::get('/admin/dashboard', 'Admin\HomeController@dashboard')->name('dashboard')->middleware(['auth','checkAdmin']);
Route::get('/admin', function() {
	return redirect()->route('dashboard');
})->name('homapage-admin')->middleware(['auth','checkAdmin']);


// Students
Route::prefix('/admin/students')->middleware(['auth','checkAdmin'])->group(function() {
	$controller = 'Admin\StudentController@';
	// List Student
	Route::get('/', $controller . 'index')->name('students.index');
	// Datatables
	Route::get('/datatables', $controller . 'datatables')->name('students.datatables');
	// Import
	Route::post('/import', $controller . 'import')->name('students.import');
	// // Form add new student
	Route::get('/create', $controller . 'create')->name('students.create');
	// // Logic add new student
	Route::post('/create/store', $controller . 'store')->name('students.create.store');
	// // Form edit student
	Route::get('/edit/{id}', $controller . 'edit')->name('students.edit');
	// // Logic edit student
	Route::post('/edit/update/{id}', $controller . 'update')->name('students.edit.update');
	// // List point of student
	// // Id of student
	// Route::get('/point/{id}', $controller . 'point')->name('students.point.index');
	// // Logic edit point of student
	// // Id of record score
	// Route::post('/point/edit/update/{id}', $controller . 'pointUpdate')->name('students.point.update');
	// // Logic delete student
	Route::post('/delete/{id}', $controller . 'destroy')->name('students.delete');
});
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
