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

Route::get('/', 'InquiryController@index')->name('home');
Route::get('/inquiry/general', 'InquiryController@general');
Route::get('/inquiry/quotation', 'InquiryController@quotation');
Route::post('/inquiry/create', 'InquiryController@create');
Route::post('/inquiry/choose-panel', 'InquiryController@choosePanel');
Route::get('/inquiry/choose-panel', 'InquiryController@choosePanelGet');
Route::get('/inquiry/create/panel-details/{id}', 'InquiryController@panelDetails');
Route::post('/inquiry/submit-quote-inquiry', 'InquiryController@submitQuoteInquiry');
