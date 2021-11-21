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


//Route::prefix('/giris')->middleware('isLogin')->group(function(){
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'Authcontroller@loginPost')->name('login.post');
Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@registerPost')->name('register.post');
Route::get('/sifre','AuthController@forgotPassword')->name('forgotPassword');
Route::post('/sifre','AuthController@forgotPasswordPost')->name('forgotPassword.post');

Route::post('/sifre/yenile','AuthController@resetPasswordPost')->name('resetPassword.post');
Route::get('/sifre/yenile/{token}','AuthController@resetPassword')->name('resetPassword');

//});

Route::prefix('/panel')->middleware('isEmployee')->group(function () {

    Route::prefix('/ayarlar')->middleware('CheckRole')->group(function(){
        Route::get('/site','ConfigController@index')->name('configs');
        Route::post('/site','ConfigController@siteConfigsUpdate')->name('site_configs.update');
        Route::get('/kullanıcı','ConfigController@userCheck')->name('user_check');
        Route::get('/kullanıcı/onay','ConfigController@userSwitch')->name('user.switch');
        Route::post('/kullanıcı/sil', 'ConfigController@delete')->name('user.delete');
        Route::post('/kullanıcı/guncelle','ConfigController@editRole')->name('user.edit.role');
        Route::get('/urun','ConfigController@productConfig')->name('product.config');
        Route::post('/urun/ekle','ConfigController@addProduct')->name('add.product');
        Route::get('/urun/guncelle','ConfigController@productGetdata')->name('product.getdata');
        Route::post('/urun/guncelle','ConfigController@editProduct')->name('edit.product');
        Route::post('/urun/sil', 'ConfigController@deleteProduct')->name('product.delete');
    });

    Route::get('/search','SearchController@search')->name('search');

    Route::get('/hesap','ConfigProfileController@index')->name('profile.config');
    Route::post('/hesap/guncelle/{id}', 'ConfigProfileController@edit')->name('user.config');
    Route::post('/hesap/sifre/{id}', 'ConfigProfileController@updatePassword')->name('password.config');
    Route::get('/cikis', 'AuthController@logout')->name('logout');

    Route::get('/dashboard', 'HomepageController@index')->name('dashboard');

    Route::get('/musteriler', 'CustomerController@index')->name('customers.index');
    Route::get('/musteriler/olustur', 'CustomerController@create')->name('customers.create');
    Route::post('/musteriler/olustur', 'CustomerController@store')->name('customers.store');
    Route::post('/musteriler/sil', 'CustomerController@delete')->name('customers.delete');
    Route::get('/musteriler/guncelle/{id}', 'CustomerController@update')->name('customers.update');
    Route::post('/musteriler/guncelle/{id}', 'CustomerController@edit')->name('customers.edit');

    Route::get('/rehber', 'ContactController@index')->name('contacts.index');
    Route::get('/rehber/olustur', 'ContactController@create')->name('contacts.create');
    Route::post('/rehber/olustur', 'ContactController@store')->name('contacts.store');
    Route::get('/rehber/guncelle/{id}', 'ContactController@update')->name('contacts.update');
    Route::post('/rehber/guncelle/{id}', 'ContactController@edit')->name('contacts.edit');
    Route::post('/rehber/sil', 'ContactController@delete')->name('contacts.delete');

    Route::get('/aktiviteler', 'ActivitiesController@index')->name('activities.index');
    Route::get('/aktiviteler/liste', 'ActivitiesController@calendar')->name('activities.calendar');
    Route::post('/aktiviteler/ekle', 'ActivitiesController@action')->name('activities.action');

    Route::get('/calisanlar', 'EmployeeController@index')->name('employees.index');
    Route::get('/calisanlar/olustur', 'EmployeeController@create')->name('employees.create');
    Route::post('/calisanlar/olustur', 'EmployeeController@store')->name('employees.store');
    Route::get('/calisanlar/guncelle/{id}', 'EmployeeController@update')->name('employees.update');


    Route::get('/teklifler','OfferController@index')->name('offer.index');
    Route::post('/teklifler','OfferController@create')->name('offer.create');
    Route::post('/teklifler/update', 'OfferController@update')->name('offer.update');
    Route::post('/teklifler/sil', 'OfferController@delete')->name('offer.delete');
    Route::get('/teklifler/siralama', 'OfferController@orders')->name('offer.orders');
    Route::get('/teklifler/getdata', 'OfferController@getData')->name('offer.getdata');
    Route::get('/teklifler/tumu', 'OfferController@all')->name('offer.all');

    Route::get('/urunler','ProductController@index')->name('product.index');
});
