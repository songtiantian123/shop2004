<?php

namespace App\Http\Controllers\index\index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class StudentController extends Controller{
    /** 添加视图*/
    public function student(){
        return view('/student/create');
    }
    /**执行添加*/
    public function store(Request $request){
        $data = $request->except('_token');// 排除_token
        $res = DB::table('student')->insert($data);
        if($res){
            return redirect('student/index');
        }
    }
    /** 列表*/
    public function index(){
        $studentInfo = DB::table('student')->get();
        return view('student/index',['studentInfo'=>$studentInfo]);
    }
    /** 删除*/
    public function destroy($id){
        echo $id;
    }
    /** 修改视图*/
    public function edit($id){
        echo '修改';
    }
}
