<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ShopaController extends Controller
{
    public function shopa(){
        //$shop = DB::table('shop')->get();
        // 从一张表中获取一行/一列
        //$shop_name = DB::table('shop')->where('shop_name','电视')->first();// 查询一个值
        //echo $shop_name->shop_name;
        //$shop = DB::table('shop')->where(['shop_id'=>3])->pluck('shop_name');
        //$aa = DB::table('shop')->where('shop_name','电视')->value('shop_name');// 查新一个值
        // 判断记录是否存在
        // DB::table('shop')->where('finalized',5)->doesntExist();
        // 使用select查询
        /**
         * select('shop_name')指定的关于所有的shop_name
         * select('shop_name','字段 as 字段') 查询几个字段
         */
        //$shop = DB::table('shop')->select('shop_name')->get();

        // distinct 方法允许你强制查询返回不重复的结果集
        //$shop = DB::table('shop')->distinct()->get();

        //$shop = DB::table('shop')->select('shop_name');
        //$name = $shop->addSelect('shop_num')->get();


    }
}























