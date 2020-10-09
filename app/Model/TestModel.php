<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class TestModel extends Model
{
    //表名
    protected $table = 'test';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
