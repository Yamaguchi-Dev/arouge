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

Route::get('/test', 'App\Http\Controllers\TestController@index')->name('test');

Route::get('/store', 'App\Http\Controllers\StoreController@index')->name('store');
Route::get('/store/login', 'App\Http\Controllers\StoreController@login')->name('store_login');
Route::get('/store/login_auth', 'App\Http\Controllers\StoreController@login_auth')->name('store_login_auth');
Route::post('/store/login_auth', 'App\Http\Controllers\StoreController@login_auth')->name('store_login_auth');
Route::get('/store/list', 'App\Http\Controllers\StoreController@list')->name('store_list');
Route::post('/store/list', 'App\Http\Controllers\StoreController@list')->name('store_list_search');
Route::post('/store/csv_download', 'App\Http\Controllers\StoreController@csv_download')->name('store_csv_download');
Route::get('/store/input', 'App\Http\Controllers\StoreController@input')->name('store_input');
Route::get('/store/confirm', 'App\Http\Controllers\StoreController@confirm')->name('store_confirm');
Route::post('/store/confirm', 'App\Http\Controllers\StoreController@confirm')->name('store_confirm_post');
Route::get('/store/regist', 'App\Http\Controllers\StoreController@regist')->name('store_regist');
Route::post('/store/regist', 'App\Http\Controllers\StoreController@regist')->name('store_regist_post');
Route::get('/store/complete', 'App\Http\Controllers\StoreController@complete')->name('store_complete');
Route::get('/store/edit/{id}', 'App\Http\Controllers\StoreController@edit')->name('store_edit_id');
Route::get('/store/edit', 'App\Http\Controllers\StoreController@edit')->name('store_edit');
Route::get('/store/update', 'App\Http\Controllers\StoreController@update')->name('store_update');
Route::post('/store/update', 'App\Http\Controllers\StoreController@update')->name('store_update_post');
Route::get('/store/edit_complete', 'App\Http\Controllers\StoreController@edit_complete')->name('store_edit_complete');
Route::get('/store/csv_input', 'App\Http\Controllers\StoreController@csv_input')->name('store_csv_input');
Route::get('/store/csv_upload', 'App\Http\Controllers\StoreController@csv_upload')->name('store_csv_upload');
Route::post('/store/csv_upload', 'App\Http\Controllers\StoreController@csv_upload')->name('store_csv_upload');
Route::get('/store/csv_complete', 'App\Http\Controllers\StoreController@csv_complete')->name('store_csv_complete');
Route::get('/store/view_change/{id}', 'App\Http\Controllers\StoreController@view_change')->name('store_view_change_id');
Route::get('/store/view_change', 'App\Http\Controllers\StoreController@view_change')->name('store_view_change');
Route::get('/store/delete', 'App\Http\Controllers\StoreController@delete')->name('store_delete');
Route::post('/store/delete_search', 'App\Http\Controllers\StoreController@delete_search')->name('store_delete_search');
Route::post('/store/delete_confirm', 'App\Http\Controllers\StoreGeleerichController@delete_confirm')->name('store_delete_confirm');
Route::post('/store/delete_done', 'App\Http\Controllers\StoreController@delete_done')->name('store_delete_done');

Route::get('/store_geleerich/list', 'App\Http\Controllers\StoreGeleerichController@list')->name('store_geleerich_list');
Route::post('/store_geleerich/list', 'App\Http\Controllers\StoreGeleerichController@list')->name('store_geleerich_list_post');
Route::get('/store_geleerich/input/{id}', 'App\Http\Controllers\StoreGeleerichController@input')->name('store_geleerich_input');
Route::get('/store_geleerich/input', 'App\Http\Controllers\StoreGeleerichController@input')->name('store_geleerich_input');
Route::get('/store_geleerich/confirm', 'App\Http\Controllers\StoreGeleerichController@confirm')->name('store_geleerich_confirm');
Route::post('/store_geleerich/confirm', 'App\Http\Controllers\StoreGeleerichController@confirm')->name('store_geleerich_confirm_post');
Route::get('/store_geleerich/regist', 'App\Http\Controllers\StoreGeleerichController@regist')->name('store_geleerich_regist');
Route::post('/store_geleerich/regist', 'App\Http\Controllers\StoreGeleerichController@regist')->name('store_geleerich_regist_post');
Route::get('/store_geleerich/complete', 'App\Http\Controllers\StoreGeleerichController@complete')->name('store_geleerich_complete');
Route::get('/store_geleerich/csv_input', 'App\Http\Controllers\StoreGeleerichController@csv_input')->name('store_geleerich_csv_input');
Route::post('/store_geleerich/csv_upload', 'App\Http\Controllers\StoreGeleerichController@csv_upload')->name('store_geleerich_csv_upload');
Route::get('/store_geleerich/csv_complete', 'App\Http\Controllers\StoreGeleerichController@csv_complete')->name('store_geleerich_csv_complete');
Route::post('/store_geleerich/view_change', 'App\Http\Controllers\StoreGeleerichController@view_change')->name('store_geleerich_view_change');
Route::get('/store_geleerich/delete', 'App\Http\Controllers\StoreGeleerichController@delete')->name('store_geleerich_delete');
Route::post('/store_geleerich/delete_search', 'App\Http\Controllers\StoreGeleerichController@delete_search')->name('store_geleerich_delete_search');
Route::post('/store_geleerich/delete_confirm', 'App\Http\Controllers\StoreGeleerichController@delete_confirm')->name('store_geleerich_delete_confirm');
Route::post('/store_geleerich/delete_done', 'App\Http\Controllers\StoreGeleerichController@delete_done')->name('store_geleerich_delete_done');

Route::get('/form/', 'App\Http\Controllers\FormController@index')->name('form');
Route::get('/form/login', 'App\Http\Controllers\FormController@login')->name('form_login');
Route::post('/form/login_auth', 'App\Http\Controllers\FormController@login_auth')->name('form_login_auth');
Route::get('/form/list', 'App\Http\Controllers\FormController@list')->name('form_list');
Route::post('/form/list', 'App\Http\Controllers\FormController@list')->name('form_list_post');
Route::get('/form/preview/{id}', 'App\Http\Controllers\FormController@preview')->name('form_preview_id');
Route::get('/form/preview', 'App\Http\Controllers\FormController@preview')->name('form_preview');
Route::get('/form/confirm_preview', 'App\Http\Controllers\FormController@confirm_preview')->name('form_confirm_preview');
Route::get('/form/input/{id}', 'App\Http\Controllers\FormController@input')->name('form_input_id');
Route::get('/form/input', 'App\Http\Controllers\FormController@input')->name('form_input');
Route::post('/form/confirm', 'App\Http\Controllers\FormController@confirm')->name('form_confirm');
Route::post('/form/regist', 'App\Http\Controllers\FormController@regist')->name('form_regist');
Route::get('/form/complete', 'App\Http\Controllers\FormController@complete')->name('form_complete');
Route::get('/form/edit/{id}', 'App\Http\Controllers\FormController@edit')->name('form_edit_id');
Route::get('/form/edit', 'App\Http\Controllers\FormController@edit')->name('form_edit');
Route::get('/form/update', 'App\Http\Controllers\FormController@update')->name('form_update');
Route::post('/form/update', 'App\Http\Controllers\FormController@update')->name('form_update_post');
Route::get('/form/edit_complete', 'App\Http\Controllers\FormController@edit_complete')->name('form_edit_complete');
Route::get('/form/search', 'App\Http\Controllers\FormController@search')->name('form_search');
Route::post('/form/search', 'App\Http\Controllers\FormController@search')->name('form_search_post');
Route::get('/form/detail/{form_id}', 'App\Http\Controllers\FormController@detail')->name('form_detail_id');
Route::get('/form/detail', 'App\Http\Controllers\FormController@detail')->name('form_detail');
Route::get('/form/csv_download/{form_id}', 'App\Http\Controllers\FormController@csv_download')->name('form_csv_download_id');
Route::get('/form/csv_download', 'App\Http\Controllers\FormController@csv_download')->name('form_csv_download');

Route::get('/input/{id}', 'App\Http\Controllers\SampleController@input')->name('sample_input_id');
Route::get('/input', 'App\Http\Controllers\SampleController@input')->name('sample_input');
Route::post('/comfirm', 'App\Http\Controllers\SampleController@comfirm')->name('sample_comfirm');
Route::get('/comfirm', 'App\Http\Controllers\SampleController@comfirm')->name('sample_comfirm');
Route::post('/regist', 'App\Http\Controllers\SampleController@regist')->name('sample_regist');
Route::get('/complete', 'App\Http\Controllers\SampleController@complete')->name('sample_complete');


// 検索用API
Route::get('/api/store/arouge_city','App\Http\Controllers\API\StoreController@arouge_city')->name('store_arouge_city');
Route::get('/api/store/arouge_search','App\Http\Controllers\API\StoreController@arouge_search')->name('store_arouge_search');
Route::get('/api/store/geleerich_search','App\Http\Controllers\API\StoreController@geleerich_search')->name('store_geleerich_search');
