<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Temp_email extends Model
{
    public $timestamps=false;//不需要框架自动维护时间
    public $table='temp_email';//要操作的数据表
    public $primarykey='id';//数据表默认的主键
}
