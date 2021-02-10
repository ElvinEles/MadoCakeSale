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

Route::get('/index','HomeController@index');
Route::get('/logout_user','HomeController@logout_user');
Route::get('/product_order','HomeController@product_order')->middleware('logincheckmiddle');
Route::get('/allproducts','HomeController@allproducts')->middleware('logincheckmiddle');
Route::get('/show_product/{id}','HomeController@show_product')->middleware('logincheckmiddle');
Route::get('/archieveproducts','HomeController@archieveproducts')->middleware('logincheckmiddle');
Route::post('/saveproduct','ProductController@saveproduct');
Route::post('/changeproduct','ProductController@changeproduct');
Route::post('/archieveproduct','ProductController@archieveproduct');
Route::post('/logincheck','HomeController@logincheck');



/*Admin*/
Route::get('/admin_category','AdminController@admin_category')->middleware('logincheckmiddle');
Route::get('/admin_statistic','AdminController@admin_statistic')->middleware('logincheckmiddle');
Route::get('/admin_message','AdminController@admin_message')->middleware('logincheckmiddle');
Route::post('/save_category','CategoryController@save_category');
Route::post('/delete_category','CategoryController@delete_category');
Route::post('/update_category','CategoryController@update_category');
Route::post('/update_message','AdminController@update_message');

/*Filter*/
Route::post('/filter','FilterController@filterallproducts');
Route::post('/adminfilter','AdminFilterController@filterallproducts');
Route::post('/filterarch','ArchieveFilterController@filterallproducts');
