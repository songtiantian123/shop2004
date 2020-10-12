<?php

namespace App\Http\Middleware;
use App\Http\Controllers\Controller;
use Closure;
use http\Env\Request;

class AdminLogin{
    public function handle($request,Closure $next){
        $user_id = $request->session()->get('user_id');
        if(empty($user_id)){
            return redirect('/index/login')->with(['msg'=>'请先登录']);
        }
        return $next($request);
    }
}
