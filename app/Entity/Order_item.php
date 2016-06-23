<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    public $table='order_item';
    public $primarykey='id';
    public $timestamps=false;
}
