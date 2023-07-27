<?php

use App\Http\Controllers\InputContoller;
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

Route::get('/pzn', function (){
    return "Hello Marcell Budi Putra";
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function (){
    return "404 by Marcell Budi Putra";
});

Route::view('/hello', 'hello', ['name' => 'Marcell']);

Route::get('/hello-again', function (){
    return view('hello', ['name' => 'Marcell']);
});

Route::get('/hello-world', function (){
    return view('hello.world', ['name' => 'Marcell']);
});

Route::get('/products/{id}', function ($productId){
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId){
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function ($categoryId){
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function ($userId = '404'){
    return "User $userId";
})->name('user.detail');

Route::get('/conflict/marcell', function (){
    return "Conflict Ini Marcell";
});

Route::get('/conflict/{name}', function ($name){
    return "Conflict $name";
});

Route::get('/produk/{id}', function ($id){
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id){
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello', [InputContoller::class, 'hello']);
Route::post('/input/hello', [InputContoller::class, 'hello']);
Route::post('/input/hello/first', [InputContoller::class, 'helloFirstName']);
Route::post('/input/hello/input', [InputContoller::class, 'helloInput']);

Route::post('/input/hello/array', [InputContoller::class, 'helloArray']);
Route::post('/input/type', [InputContoller::class, 'inputType']);

Route::post('/input/filter/only', [InputContoller::class, 'filterOnly']);
Route::post('/input/filter/except', [InputContoller::class, 'filterExcept']);

Route::post('/input/filter/merge', [InputContoller::class, 'filterMerge']);

