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

use App\Author;
use App\Book;
use App\Http\Controllers\Article as ArticleController;
Route::get('/removeitem/{id}', [
    'uses' => 'ProductController@getReduceByOne',
    'as' => 'product.reduceByOne'

]);

Route::get('/reduceitem/{id}', [
    'uses' => 'ProductController@getRemoveItem',
    'as' => 'product.remove',
]);

Route::get('/', [  /* ko prvič naložimo stran dobimo vse knjige */
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index'

]);

Route::get('/authenticated', [  /* ko prvič naložimo stran dobimo vse knjige */
    'uses' => 'ProductController@getIndex2',
    'as' => 'product.index2'

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


Route::get('/authenticatedshoppingcart', [
    'uses' => 'ProductController@getCart2',
    'as' => 'product.shoppingCart2'
]);




Route::get('/signup',[
    'uses' => 'UserController@getSignup',
    'as' => 'user.signup'
]);

Route::get('/user/change',[
    'uses' => 'UserController@getChangeCredentials',
    'as' => 'user.change',
    'middleware' =>'auth'
]);

Route::get('/user/changeSales/{id}',[
    'uses' => 'UserController@getUpdateSales',
    'as' => 'user.changeSales',
    'middleware' =>'auth'
]);

Route::post('/user/changeSales/{id}', 'UserController@updateSales')->name('user.changeSalesUpdate');



Route::get('/remove/{id}', [
    'uses' => 'UserController@deleteUser',
    'as' => 'user.delete',
    'middleware' =>'auth'
]);


Route::get('/deleteitem/{id}', [
    'uses' => 'ProductController@deleteItem',
    'as' => 'product.deleteItem',
    'middleware' =>'auth'
]);




Route::get('/createSales/', [
    'uses' => 'UserController@getCreateSales',
    'as' => 'user.getCreateSales',
    'middleware' =>'auth'
]);

Route::get('/edititem/{id}', [
    'uses' => 'ProductController@getEditProduct',
    'as' => 'product.getEditProduct',
    'middleware' =>'auth'
]);

Route::post('/edititem/{id}',[
    'uses' => 'ProductController@editProduct',
    'as' => 'product.editProduct',
    'middleware' =>'auth'
]);

Route::post('/createSales/',[
    'uses' => 'UserController@createSales',
    'as' => 'user.createSales',
    'middleware' =>'auth'
]);

Route::get('/createCustomer/', [
    'uses' => 'UserController@getCreateCustomer',
    'as' => 'user.getCreateCustomer',
    'middleware' =>'auth'
]);
Route::post('/createCustomer/',[
    'uses' => 'UserController@createCustomer',
    'as' => 'user.createCustomer',
    'middleware' =>'auth'
]);


Route::get('/createProduct/', [
    'uses' => 'ProductController@getCreateProduct',
    'as' => 'product.getCreateProduct',
    'middleware' =>'auth'
]);
Route::post('/createProduct/',[
    'uses' => 'ProductController@createProduct',
    'as' => 'product.createProduct',
    'middleware' =>'auth'
]);



Route::get('/orderconfirm/{id}', [
    'uses' => 'ProductController@confirmOrder',
    'as' => 'order.confirm',
    'middleware' =>'auth'
]);

Route::get('/orderdecline/{id}', [
    'uses' => 'ProductController@declineOrder',
    'as' => 'order.decline',
    'middleware' =>'auth'
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

Route::get('/api/books', function(){
   // return new ArticleController( Book::all());
    $books2 = Book::all();
    $books = $books2; //moramo ustvariti novo kopijo for some reason
    $count = 0;
    foreach ($books2 as $kng){
        $ajdiAvtorja = $kng['IDAVTORJA']; //pridobimo id avtorja od knjige s tabele knjih
        $idAvtorja = Author::where('idAvtorja', $ajdiAvtorja) -> get(); //dobimo objekt avtor z tem id
        $imeAvt = ($idAvtorja[0]['IMEAVTORJA']); //uzamemo ime in ga dodamo objektu Book
        $books[$count]->IDAVTORJA = $imeAvt;
        $count++;
    }
    $jason = $books -> toJson();
    return $jason;
});

Route::get('/api/books/{id}', function($id){
    $knjiga = Book::where('id', $id)->first();
    $avtor = Author::where('idAvtorja', $knjiga['IDAVTORJA'])->first();
    $knjiga->IDAVTORJA = $avtor -> IMEAVTORJA;
    return $knjiga;

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

