<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
class GoodsController extends Controller{
    /** 商品详情*/
    public function detail(Request $request){
        return view('goods.detail');
    }
    /** 商品列表*/
    public function goodlist(){
        $list = GoodsModel::get();
        return view('goods.list',['list'=>$list]);
    }
}
