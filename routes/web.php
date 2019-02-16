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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'laporan', 'middleware' => 'auth'], function(){
	Route::get('/bulanan', 'Laporan\BulananController@index');
	Route::get('/bulanan/ubah/{id}', 'Laporan\BulananController@ubah');
	Route::get('/bulanan/unggah', 'Laporan\BulananController@create');
	Route::post('/bulanan/datatables', 'Laporan\BulananController@dataTablesBulanan');
	Route::post('/bulanan/unggah/store', 'Laporan\BulananController@store');
	Route::post('/bulanan/unggah/update', 'Laporan\BulananController@update');
	Route::post('/bulanan/unggah/hapus', 'Laporan\BulananController@hapus');
	Route::post('/bulanan/unggah/delete', 'Laporan\BulananController@delete');

	Route::get('/triwulan', 'Laporan\TriwulanController@index');
	Route::get('/triwulan/ubah/{id}', 'Laporan\TriwulanController@ubah');
	Route::get('/triwulan/unggah', 'Laporan\TriwulanController@create');
	Route::post('/triwulan/unggah/store', 'Laporan\TriwulanController@store');
	Route::post('/triwulan/unggah/update', 'Laporan\TriwulanController@update');
	Route::post('/triwulan/unggah/delete', 'Laporan\TriwulanController@delete');

	Route::get('/semester', 'Laporan\SemesterController@index');
	Route::get('/semester/ubah/{id}', 'Laporan\SemesterController@ubah');
	Route::get('/semester/unggah', 'Laporan\SemesterController@create');
	Route::post('/semester/unggah/store', 'Laporan\SemesterController@store');
	Route::post('/semester/unggah/update', 'Laporan\SemesterController@update');
	Route::post('/semester/unggah/delete', 'Laporan\SemesterController@delete');

	Route::get('/tahunan', 'Laporan\TahunanController@index');
	Route::get('/tahunan/ubah/{id}', 'Laporan\TahunanController@ubah');
	Route::get('/tahunan/unggah', 'Laporan\TahunanController@create');
	Route::post('/tahunan/unggah/store', 'Laporan\TahunanController@store');
	Route::post('/tahunan/unggah/update', 'Laporan\TahunanController@update');
	Route::post('/tahunan/unggah/delete', 'Laporan\TahunanController@delete');

	Route::get('/revisi', 'Laporan\RevisiController@index');

	

});
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){
	

	Route::get('/', 'Users\UsersController@index');
	Route::get('/ubah/{id}', 'Users\UsersController@ubah');
	Route::post('/update', 'Users\UsersController@update');



});