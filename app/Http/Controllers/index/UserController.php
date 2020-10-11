<?php

namespace App\Http\Controllers\index;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $data['reg_time'] = time();// 注册时间
        $data['password'] = md5($data['password']);// 密码加密
        $res = UserModel::insert($data);
//        dd($res);
        if ($res) {
            return redirect('/user/login');
        }
    }
    /** 登录视图*/
    public function login(){
        return view('user/login');
    }
    /** 执行登录*/
    public function loginDo(Request $request){
        // 得到当前用户的真实id
        $ip = $request->getClientIp();
        $user_name = $request->input('user_name');
        $user_name1=$request->input('password');
        $key = 'login:count:' . $user_name;
        //dd($key);
        // 检测用户是否已被锁定
        $count = Redis::get($key);
//        echo $count;exit;
        //echo '密码错误次数：'.$count;die;
        if ($count>=4) {
            return redirect('/user/login')->with('msg','错误次数过多，已被锁定一小时');
        }
        //$user_pass = $request->input('user_pass');
        /*if(substr_count($user_name['user_name'],'@')>0){
            if(substr_count($user_name['user_name'],'@')>0){
                $where = ['email'=>$user_name['user_name']];
            }else if(strlen($user_name)==11){
                $where = ['user_tel'=>$user_name['user_name']];
            }else{
                $where = ['user_name'=>$user_name['user_name']];
            }
        }*/

       // 使用加密密码
        $res = UserModel::where(['user_name' => $user_name])
            ->orWhere(['email' => $user_name])
            ->orWhere(['tel' => $user_name])
            ->first();
//        dd($res);
        if (empty($res)){
            return redirect('user/login')->with(['msg' => '你输入的账号或密码有误']);
        }
        if(is_object($res)){
            $res = $res->toArray();
        }
//        dd($res);
        $user_name1=$request->input('password');
//        echo $user_name1;exit;
        $user_name1 = md5($user_name1);
        if($user_name1==$res['password']){
            $loginInfo = ['last_login'=>time(),'last_ip'=>$ip,'login_count'=>$res['login_count']+1];
            UserModel::where('uid',$res['uid'])->update($loginInfo);
            return redirect('user/login');
        }else{
            $ten_minute = 10 * 60;//
            if(time() > Redis::get('right_login'.$res['uid'])){
                if(Redis::get('error_login',$res['uid'])>time()-$ten_minute){
                    if(Redis::get('error_login'.$res['uid'])>=5){
                        $right_time = time()+3600;
                        Redis::set('right_login'.$res['uid'],$right_time);
                        return redirect('user/login')->with(['msg'=>'你输入的账号或密码有误,错误次数,已达到5次,锁定一小时']);
                    }else{
                        $ago_time = time()-600;
                        // 错误次数
                        if(empty(Redis::get('error_login'.$res['uid']))){// 没有错误从0开始
                            $error_count = 1;
                            Redis::set('error_login'.$res['uid'.$error_count]);
                            Redis::set('error_time'.$res['uid'],time ());
                        }else{ //已经错过 从错误的基础上再加+1
                            $error_count = Redis::get('error_login'.$res['uid']);
                            Redis::set('error_login'.$res['uid'],$error_count+1);
                        }
                    }
                }else{
                    Redis::set('error_time'.$res['uid'],time());
                }
            }else{
                return redirect('user/login')->with(['msg'=>'你输入的密码以经错误5次,锁定一小时']);
            }
            // 密码不正确 记录错误次数
                $count = Redis::incr($key);
                return redirect('user/login')->with(['msg'=>'你输入的账号或密码有误,错误次数: '.$count.'最近错误的时间'.Redis::get('error_time'.$res['uid'])]);
        }



    }
}











