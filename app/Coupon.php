<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupon";
    public $timestamps = false;

    protected $primaryKey = 'coupon_id';
    protected $fillable = [
          'coupon_name ',  
          'coupon_qty', 
          'coupon_sale_number', 
          'coupon_code', 
          'coupon_condition',
          'coupon_date_start',
          'coupon_date_end',
          'coupon_status',
          'coupon_used',
    ];
}
