<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', ['as' => 'login', 'uses' => 'LoginController@login']);
Route::post('login', 'LoginController@login');
Route::post('register', 'RegisterController@register');
Route::apiResource('users', 'UserController');
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', 'AuthenticationController@user');
    Route::post('logout', 'LoginController@logout');

    Route::get('users/check/me', 'UserController@meUser');
});

//Admin
Route::apiResource('adm/categories', 'CategoryController');
Route::get('adm/categories/options/data', 'CategoryController@optionsData');
Route::post('adm/categories/delete/checked', 'CategoryController@deleteChecked');

Route::apiResource('adm/products', 'ProductController');
Route::delete('adm/products/attribute/delete/{id}', 'ProductController@destroyProductAttribute');
Route::post('adm/products/gallery/save', 'ProductController@galleryStore');
Route::get('adm/products/options/data', 'ProductController@optionsData');
Route::post('adm/products/delete/checked', 'ProductController@deleteChecked');
Route::post('adm/products/c/copy', 'ProductController@copy');

Route::apiResource('adm/orders', 'OrderController');
Route::get('adm/orders/options/data', 'OrderController@optionsData');
Route::post('adm/orders/delete/checked', 'OrderController@deleteChecked');

Route::apiResource('adm/media', 'MediaController');
Route::post('adm/media/sort', 'MediaController@sort');
Route::post('adm/upload/media', 'MediaController@uploadProductMedia');
Route::post('adm/files/delete', 'MediaController@deleteFile');

//Web
Route::apiResource('categories', 'Web\CategoryController');
Route::apiResource('products', 'Web\ProductController');
Route::get('new/products', 'Web\ProductController@newAll');
Route::get('last/products', 'Web\ProductController@newLimit');
Route::get('related/products', 'Web\ProductController@related');
Route::get('archive', 'Web\ProductController@archiveAll');

//Check type for multi-nested-slug page
Route::get('type/{url}', 'Web\ProductController@type')->where('url', '(.*)');
Route::get('search/products', 'Web\ProductController@search');

Route::post('order', 'Web\OrderController@order');
