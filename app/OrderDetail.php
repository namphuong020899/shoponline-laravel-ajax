<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";
    public $timestamps = false;

    protected $primaryKey = 'order_details_id';
    protected $fillable = [
          'order_code',  
          'product_id', 
          'product_price', 
          'product_sales_quantity',
          'product_coupon',
          'product_feeship',
          'order_detail_review'
    ];

    public function product_order(){
      return $this->belongsTo('App\Products','product_id');
    }
}
