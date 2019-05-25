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
Route::group(['prefix'=>'backend', 'middleware'=>'backend'],function(){
    
    /*
     * Dashboard
     */
    Route::get('/', 'DashboardController@index')->name('dhashboard');
    Route::post('/load-general-inquiry', 'DashboardController@loadGeneralInquiry');
    Route::post('/load-general-inquiry-statics', 'DashboardController@loadGeneralInquiryStatics');
    Route::post('/load-quote-inquiry-statics', 'DashboardController@loadQuoteInquiryStatics');
    Route::get('/testImap', 'DashboardController@testImap');
    /*
     * Common
     */
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/inquiry/toggle-status', 'InquiryController@toggleStatus');
    Route::get('/inquiry/edit/{id}/{v_id}', 'InquiryController@edit');
    Route::get('/inquiry/edit/{id}', 'InquiryController@generalEdit');
    Route::get('/inquiry/get-inquiry-form/{id}', 'InquiryController@getInquiryForm');
    Route::get('/inquiry/get-panels-section/{id}/{v_id}', 'InquiryController@getPanelsSection');
    Route::get('/inquiry/get-email-section/{id}/{type?}', 'InquiryController@getEmailSection');
    
    Route::post('/inquiry/update', 'InquiryController@update');
    Route::get('/inquiry/quotation', 'InquiryController@quotation');
    Route::get('/inquiry/quotation/load-quote-inquiry', 'InquiryController@loadQuoteInquiry');
    Route::get('/inquiry-detail/detail-inquiry/{id}', 'InquiryDetailController@detailInquiry');
    Route::post('/inquiry-detail/load-quote-detail/{id}', 'InquiryDetailController@loadQuoteDetail');
    Route::post('/inquiry-detail/clone-quote', 'InquiryDetailController@cloneQuote');
    /*
     * Directory/Folder
     */
    Route::get('/directory/load-file-section/{id}', 'DirectoryController@loadFIleSection');
    Route::get('/inquiry/media/{id}', 'DirectoryController@media');
    Route::post('/directory/create', 'DirectoryController@create');
    Route::post('/directory/upload-file', 'DirectoryController@uploadFileInDirectory');
    Route::post('/directory/load-file-directory/{id}', 'DirectoryController@loadFileDirectory');
    Route::post('/directory/delete-files/{id}', 'DirectoryController@DeleteUploadedFiles');
    Route::post('/directory/file-rename', 'DirectoryController@directoryFileRename');
    
    /*
     * Trash
     */
    Route::get('/inquiry/trash', 'InquiryController@trash');
    Route::post('/load-trash-inquiry', 'InquiryController@loadTrashInquiry');
    Route::get('/inquiry/delete-inquiry/{id}', 'InquiryController@delete');
    
    /**
     * Global email inbox
     */
    Route::get('/emails/global-inbox', 'EmailsController@index')->middleware('admin');
    Route::post('/emails/load-emails', 'EmailsController@loadEmails');
    Route::post('/emails/show-email-detail', 'EmailsController@showEmailDetail');
    Route::get('/emails/sync-emails', 'EmailsController@syncEmails');
    Route::post('/emails/mark-as-read', 'EmailsController@markAsRead');
    Route::get('/emails/get-unread-count/{id?}', 'EmailsController@unreadCount');
    Route::get('/emails/show-files/{id}', 'EmailsController@showFiles');
    Route::post('/emails/global-send-mail', 'EmailsController@globalSendMail');
    Route::post('/emails/move-inquiry-emails', 'EmailsController@moveInquiryEmails');
   
    /**
     * Profile
     */
     Route::get('/my-profile', 'MyProfileController@index');
     Route::post('/my-profile/change-password', 'MyProfileController@changePassword');
     Route::post('/my-profile/update-profile', 'MyProfileController@updateProfile');
     
     /**
     * Sales Rep
     */
     Route::get('/salesrep', 'SalesRepController@index');
     Route::post('/load-sales-rep-statics', 'SalesRepController@loadSalesRepStatics');
     Route::post('/load-sales-rep', 'SalesRepController@loadSalesRep');
     Route::post('/sales-rep/toggle-status', 'SalesRepController@toggleStatus');
     Route::post('/sales-rep/create', 'SalesRepController@create');
     Route::get('/sales-rep/edit/{id}', 'SalesRepController@edit');
     Route::post('/sales-rep/update', 'SalesRepController@update');
     
     
      /**
     * Sales Manager
     */
     Route::get('/sales-manager', 'SalesManagerController@index');
     Route::post('/load-sales-manager-statics', 'SalesManagerController@loadSalesManagerStatics');
     Route::post('/load-sales-manager', 'SalesManagerController@loadSalesManager');
     Route::post('/sales-manager/toggle-status', 'SalesManagerController@toggleStatus');
     Route::post('/sales-manager/create', 'SalesManagerController@create');
     Route::get('/sales-manager/edit/{id}', 'SalesManagerController@edit');
     Route::post('/sales-manager/update', 'SalesManagerController@update');
     
     /**
     * Estimator
     */
     Route::get('/estimator', 'EstimatorController@index');
     Route::post('/load-estimator-statics', 'EstimatorController@loadEstimatorStatics');
     Route::post('/load-estimator', 'EstimatorController@loadEstimator');
     Route::post('/estimator/toggle-status', 'EstimatorController@toggleStatus');
     Route::post('/estimator/create', 'EstimatorController@create');
     Route::get('/estimator/edit/{id}', 'EstimatorController@edit');
     Route::post('/estimator/update', 'EstimatorController@update');
    
});

Route::group(['prefix'=>'backend'],function(){
    
    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/forgot-password', 'Auth\ForgotPasswordController@index');
    Route::post('/forgot-password-submit', 'Auth\ForgotPasswordController@forgotPasswordSubmit');
    Route::get('/forgot-password/reset/{token}', 'Auth\ForgotPasswordController@Reset');
    Route::post('/reset-password', 'Auth\ForgotPasswordController@resetPassword');
    
    
});
