<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //表名
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
