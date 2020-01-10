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


Route::get('/remove/{id}', [
    'uses' => 'ProductController@getReduceByOne',
    'as' => 'product.reduceByOne',
]);

Route::get('/reduce/{id}', [
    'uses' => 'ProductController@getRemoveItem',
    'as' => 'product.remove',
]);


Route::get('/shopping-cart', [
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart'
]);


Route::get('/signup',[
    'uses' => 'UserController@getSignup',
    'as' => 'user.signup'
]);

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

