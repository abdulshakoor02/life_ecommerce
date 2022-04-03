<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


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

// Route::get('/', function () {
//     return Inertia::render('Dashboard', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/','employeeController@index');
Route::get('/create','employeeController@create');
Route::get('/addproduct','employeeController@addproduct');
Route::post('/store','employeeController@store');
Route::get('/edit/{employee}','employeeController@edit');
Route::post('/cart_add','employeeController@cart_add');
Route::get('/cart','employeeController@cart');
Route::put('/update/{employee}','employeeController@update');
Route::get('/delete_cart/{cartid}','employeeController@cart_delete');
Route::post('/create_order','employeeController@create_order');
Route::get('/transactions','employeeController@transactions');
Route::get('/orders','employeeController@orders')->name('orders');
Route::post('/update_trans','employeeController@update_trans');
Route::post('/search_order','employeeController@search_order');







Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
