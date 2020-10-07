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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test',function(){
    echo 'hello';
});

Route::get('/hello','TestController@hello');
/** 学生表增删改查*/
Route::get('student/create','StudentController@student');// 添加视图
Route::post('student/store','StudentController@store');// 执行添加
Route::get('student/index','StudentController@index');// 列表页面
Route::get('student/destroy','StudentController@destroy');// 执行删除


/** 商品表的增删改查*/
Route::get('/shop','ShopController@shop');

