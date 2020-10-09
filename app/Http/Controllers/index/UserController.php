<?php

namespace App\Http\Controllers\index;
use App\Http\Controllers\Controller;
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
            return redirect('/user/login');
        }
    }
    /** 登录视图*/
    public function login(){
        return view('user.login');
    }
    /** 执行登录*/
    public function loginDo(Request $request){
      $data = $request->all();
        $res = UserModel::where(['user_name'=>$data])->orWhere(['email'=>$data])->orWhere(['tel'=>$data])->first();
        //$res = UserModel::where(['user_name'=>$data])->first();
        //$res = UserModel::orWhere(['email'=>$data])->first();
        //$res = UserModel::orWhere(['tel'=>$data])->first()->toArray();
        if($res){
            return redirect('student.create');
        }
    }
}
