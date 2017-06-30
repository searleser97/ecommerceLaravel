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

Route::get('/', 'MainController@home');

Route::get('/carrito', 'ShoppingCartsController@index');
Route::post('/carrito', 'ShoppingCartsController@checkout');

Route::get('/orders/new', 'OrdersController@store');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('products/images/{filename}', function($filename) {
    $path = storage_path("app/productImgs/$filename");
    if(!\File::exists($path)) abort(404);
    $file = \File::get($path);
    $type = \File::mimetype($path);
    $response = \Response::make($file, 200);

    $response->header('Content-Type', $type);

    return $response;
});

Auth::routes();

Route::resource('products', 'ProductsController');

Route::resource('in_shopping_carts', 'InShoppingCartsController', [
    'only' => ['store', 'destroy']
]);

Route::resource('orders', 'OrdersController', [
    'except' => ['create', 'edit']]);


