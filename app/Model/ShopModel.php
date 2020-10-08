<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopModel extends Model
{
    //表名
    protected $table = 'shop';
    protected $primaryKey = 'shop_id';
    public $timestamps = false;
}
