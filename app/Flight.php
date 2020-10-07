<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentController extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    /** 自增id*/
    protected $primaryKey = 'id';
    /**数据库表*/
    protected $table = 'laravel';
    public $timestamps=false;
    protected $guarded =[];

}
