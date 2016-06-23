<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public $table='product';//要操作的数据表
    public $primarykey='id';//数据表默认的主键
}
