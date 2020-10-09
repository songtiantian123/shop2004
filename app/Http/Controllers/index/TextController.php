<?php

namespace App\Http\Controllers\index;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\GoodsModel;
class TextController extends Controller{
    /** 商品详情*/
    public function text(Request $request){
//        Redis::set('aa','bb');
//        $v = Redis::get('aa');
//        dd($v);
        $num = Redis::incr('count');
        dd($num);
    }
}
