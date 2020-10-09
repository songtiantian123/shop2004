<?php

namespace App\Http\Controllers\index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\UserModel;

class UserController extends Controller{
    /** 注册视图*/
    public function user(){
        return view('user.regist');
    }
    /** 执行注册*/
    public function registerDo(Request $request){
        $data = $request->except('_token');
        $data['reg_time'] =time();// 注册时间
        // 密码加密
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
        $user_name = $request->input('user_name');
        $user_pass = $request->input('user_pass1');
        $key = 'login:count:'.$user_name;
        // 检测用户是否已被锁定
        $count = Redis::get($key);
        //echo '密码错误次数：'.$count;die;
        if($count>5){
            echo '密码输入错误过多,用户已被锁定';
            die;
        }
        $res = UserModel::where(['user_name'=>$user_name])
            ->orWhere(['email'=>$user_name])
            ->orWhere(['tel'=>$user_name])
            ->first();
        if(!$res){
            die('用户不存在');
        }
        $p = password_verify($user_pass,$res->password);
        if(!$p){
            // 密码不正确 记录错误次数
            $count = Redis::incr($key);
            echo '错误次数：'.$count;
            die;
        }
        // 密码正确
    }
}
