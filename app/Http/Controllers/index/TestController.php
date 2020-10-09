<?php

namespace App\Http\Controllers\index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TestModel;
class TestController extends Controller
{
    /** 显示视图*/
    public function hello(){
        return view('test.create');// 也就是 test视图文件夹.里面的create的文件
    }
    /** 执行添加*/
    public function store(Request $request){
        $data = $request->except('_token');
        $res = TestModel::insert($data);
        print_r($res);die;
    }
    public function test1(){
        echo 'aaa';
        Redis::set('aaa','bbb');
        $v = Redis::get('aaa');
        dd($v);
    }
}
