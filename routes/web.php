<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/manage', 'UserController@manage')->name('manage');

Route::get('/home', 'HomeController@index')->name('home');
Route::GET('/vme', 'HomeController@vme')->name('vme');
Route::GET('/htt', 'HomeController@htt')->name('htt');

Route::GET('/3g_excel', 'HomeController@treg_excel')->name('3g_excel');
Route::GET('/unmatched_treg_excel', 'HomeController@unmatched_treg_excel')->name('unmatched_treg_excel');
Route::GET('/matched_treg_excel', 'HomeController@matched_treg_excel')->name('matched_treg_excel');

Route::GET('/vme_excel', 'HomeController@vme_excel')->name('vme_excel');
Route::GET('/unmatched_vme_excel', 'HomeController@unmatched_vme_excel')->name('unmatched_vme_excel');
Route::GET('/matched_vme_excel', 'HomeController@matched_vme_excel')->name('matched_vme_excel');

Route::GET('/htt_excel', 'HomeController@htt_excel')->name('htt_excel');
Route::GET('/unmatched_htt_excel', 'HomeController@unmatched_htt_excel')->name('unmatched_htt_excel');
Route::GET('/matched_htt_excel', 'HomeController@matched_htt_excel')->name('matched_htt_excel');


Route::post('import-csv-3g','CsvController@store3g')->name('import_csv_3g');
Route::post('import-csv-htt','CsvController@storehtt')->name('import_csv_htt');
Route::post('import-csv-vme','CsvController@storevme')->name('import_csv_vme');


Route::resource('users', 'UserController');
