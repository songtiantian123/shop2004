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

Route::get('/test',function(){
    echo 'hello';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info',function(){
    phpinfo();
});


Route::get('hello/create','index\TestController@hello');


/** 学生表增删改查*/
Route::get('student/create','index\StudentController@student');// 添加视图
Route::post('student/store','index\StudentController@store');// 执行添加
Route::get('student/index','index\StudentController@index');// 列表页面
Route::get('student/destroy','index\StudentController@destroy');// 执行删除

/** DB操作数据库*/
Route::get('/shop','index\ShopController@shop');
/** 模型操作数据库*/
Route::get('/a','index\ShopController@a');
Route::get('/text','index\TextController@text');

/** 用户的 注册*/
Route::get('user/regist','index\UserController@user');// 注册视图
Route::post('user/registerDo','index\UserController@registerDo');// 执行注册

/** 用户的登录*/
Route::get('user/login','index\UserController@login');// 登录视图
Route::post('user/loginDo','index\UserController@loginDo');// 执行登录


/** 商品*/
Route::get('/goods/detail','index\GoodsController@detail');/** 商品详情*/
Route::get('/goods/list','index\GoodsController@goodlist');/** 商品列表*/


