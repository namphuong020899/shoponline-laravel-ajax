<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";
    public $timestamps = false;

    protected $primaryKey = 'order_id';
    protected $fillable = [
          'customer_id ',  
          'shipping_id', 
          'order_status', 
          'order_code', 'order_pay'
    ];


}
