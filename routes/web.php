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

Route::get('/removeitem/{id}', [
    'uses' => 'ProductController@getReduceByOne',
    'as' => 'product.reduceByOne',
]);

Route::get('/reduceitem/{id}', [
    'uses' => 'ProductController@getRemoveItem',
    'as' => 'product.remove',
]);

Route::get('/', [  /* ko prvič naložimo stran dobimo vse knjige */
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index'

]);


Route::get('/add-to-cart/{id}', [
    'uses' => 'ProductController@getAddToCart',
    'as' => 'product.addToCart'
]);


Route::get('/checkout', [
    'uses' => 'ProductController@getCheckout',
    'as' => 'checkout',
    'middleware' =>'auth'
]);





Route::get('/shopping-cart', [
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart'
]);


Route::get('/signup',[
    'uses' => 'UserController@getSignup',
    'as' => 'user.signup'
]);

Route::get('/user/change',[
    'uses' => 'UserController@getChangeCredentials',
    'as' => 'user.change'
]);

Route::get('/user/changeSales/{id}',[
    'uses' => 'UserController@getUpdateSales',
    'as' => 'user.changeSales'
]);

Route::post('/user/changeSales/{id}', 'UserController@updateSales')->name('user.changeSalesUpdate');



Route::get('/remove/{id}', [
    'uses' => 'UserController@deleteUser',
    'as' => 'user.delete',
]);


Route::get('/deleteitem/{id}', [
    'uses' => 'ProductController@deleteItem',
    'as' => 'product.deleteItem',
]);




Route::get('/createSales/', [
    'uses' => 'UserController@getCreateSales',
    'as' => 'user.getCreateSales',
]);

Route::get('/edititem/{id}', [
    'uses' => 'ProductController@getEditProduct',
    'as' => 'product.getEditProduct',
]);

Route::post('/edititem/{id}',[
    'uses' => 'ProductController@editProduct',
    'as' => 'product.editProduct'
]);

Route::post('/createSales/',[
    'uses' => 'UserController@createSales',
    'as' => 'user.createSales'
]);

Route::get('/createCustomer/', [
    'uses' => 'UserController@getCreateCustomer',
    'as' => 'user.getCreateCustomer',
]);
Route::post('/createCustomer/',[
    'uses' => 'UserController@createCustomer',
    'as' => 'user.createCustomer'
]);


Route::get('/createProduct/', [
    'uses' => 'ProductController@getCreateProduct',
    'as' => 'product.getCreateProduct',
]);
Route::post('/createProduct/',[
    'uses' => 'ProductController@createProduct',
    'as' => 'product.createProduct'
]);



Route::get('/orderconfirm/{id}', [
    'uses' => 'ProductController@confirmOrder',
    'as' => 'order.confirm',
]);

Route::get('/orderdecline/{id}', [
    'uses' => 'ProductController@declineOrder',
    'as' => 'order.decline',
]);


Route::post('/user/change', 'UserController@updateAccount')->name('user.update');

Route::post('account', 'AccountSettingsController@updateAccount');

Route::post('/signup',[
    'uses' => 'UserController@postSignup',
    'as' => 'user.signup'
]);


Route::get('/signin',[
    'uses' => 'UserController@getSignin',
    'as' => 'user.signin'

]);

Route::post('/login',[
    'uses' => 'UserController@postSignin',
    'as' => 'user.signin'
]);

Route::get('/user/profile', [
    'uses' => 'UserController@getProfile',
    'as' =>'user.profile',
    'middleware' =>'auth'
]);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

