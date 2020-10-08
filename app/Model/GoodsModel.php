<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    //表名
    protected $table = 'p_goods';
    protected $primaryKey = 'goods_id';
    public $timestamps = false;
}
