<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ShopModel;
class ShopController extends Controller
{
    /** DB操作数据库*/
    public function shop(){
       echo 'DB';
    }
    /** model操作数据库*/
    public function a(){
        // 查询
        //$data = shopModel::limit(2)->get()->toArray();
        //echo '<pre>';print_r($data);echo '</pre>';
        $data = shopModel::orderBy('shop_id','desc')->get()->toArray();
        //echo '<pre>';print_r($data);echo'</pre>';
        //$model = shopModel::findOrFail(1);
        //$model = shopModel::where('shop_num','<',50)->firstOrFail()->toArray();
        //echo '<pre>';print_r($model);echo'</pre>';
        /** 获取聚合函数*/
        //$count = shopModel::where('shop_num',23)->count();
        //echo '<pre>';print_r($count);echo'</pre>';
        //$max = shopModel::where('shop_id',6)->max('shop_num');
        //echo '<pre>';print_r($max);echo'</pre>';
        //$shop = shopModel::where(['shop_name'=>'电视'])->first()->toArray();
        //echo '<pre>';print_r($shop);echo'</pre>';
        // 更新
        $data = [
            'shop_name' => 'hi',
            'shop_num' => 70
        ];
        $res = shopModel::where(['shop_id'=>4])->update($data);
        //var_dump($res);
        // 删除
        $delete = shopModel::destroy(1);
        //echo '<pre>';print_r($delete);echo'</pre>';
        $del = shopModel::where('shop_id',3)->delete();
        //echo '<pre>';print_r($del);echo'</pre>';
        // 添加
        $insert = [
            'shop_name' => '桌子',
            'shop_num' => 1000,
            'shop_price' => 300
        ];
        $r = shopModel::where(['shop_id'=>8])->insert($insert);
        echo '<pre>';print_r($r);echo'</pre>';
    }
}
