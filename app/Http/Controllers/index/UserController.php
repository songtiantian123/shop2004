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
//        dd($data);
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
//        if ($count>=4) {
//            return redirect('/user/login')->with('msg','错误次数过多，已被锁定一小时');
//        }
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
        // 打印出用户剩余的时间
        $login_time = ceil(Redis::TTL("login_time:".$res['uid'])/60);
//        dd($login_time);
        if(!empty($login_time)){
            return redirect('user/login')->with(['msg'=>'该账户密码输入错误过多,已锁定一小时,剩余时间'.$login_time.'分钟']);
        }
        // 判断用户是否已经锁定
        if($count>=4){
            Redis::setex("login_time:".$res['uid'],3600,Redis::get("login_time:".$res['uid']));
            return redirect('user/login')->with(['msg'=>'该账号输入错误次数过多，已锁定一小时']);
        }
        $user_name1=$request->input('password');
//        echo $user_name1;exit;
        $user_name1 = md5($user_name1);
        if($user_name1==$res['password']){
            $loginInfo = ['last_login'=>time(),'last_ip'=>$ip,'login_count'=>$res['login_count']+1];
            UserModel::where('uid',$res['uid'])->update($loginInfo);
            // 用户登录成功后设置session存入用户的信息
            session(['uid'=>$res['uid'],'user_name'=>$res['user_name'],'tel'=>$res['tel'],'email'=>$res['email']]);
            // 使用重定向放回视图
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
    // 退出
    public function exit(Request $request){
        session(['uid'=>null,'user_name'=>null,'tel'=>null,'email'=>null]);
        $uid = $request->session()->get('uid');
        if(empty($uid)){
            return redirect('user/login')->when(['msg'=>'退出成功']);
        }
    }
}











