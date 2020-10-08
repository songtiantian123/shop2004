<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;

class UserController extends Controller{
    /** 注册视图*/
    public function user(){
        return view('user.regist');
    }
    /** 执行注册*/
    public function registerDo(Request $request){
        $data = $request->except('_token');
        $res = UserModel::insert($data);
        if($res) {
            return redirect('user.login');
        }
    }
    /** 登录视图*/
    public function login(){
        return view('user.login');
    }
    /** 执行登录*/
    public function loginDo(){
        $data = UserModel::get();
        dd($data);
    }
}
