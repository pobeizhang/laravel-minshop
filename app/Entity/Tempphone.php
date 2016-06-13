<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Tempphone extends Model
{
    public $timestamps=false;//不需要框架自动维护时间
    public $table='tempphone';//要操作的数据表
    public $primarykey='id';//数据表默认的主键
}
