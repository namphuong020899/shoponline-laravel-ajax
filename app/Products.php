<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "product";
    public $timestamps = false;

    protected $primaryKey = 'product_id';
    protected $fillable = [
    	'product_name', 'product_slug','category_id','brand_id','product_desc','product_content','product_price','product_image','product_status','promotion_price','product_view','product_date_sale','product_hour_sale'
    ];
    // protected $guarded = [];

    public function brandproduct(){
    	return $this->belongsTo('App\Brand','brand_id');
    }
    public function pro_cate(){
    	return $this->belongsTo('App\CategoryProduct','category_id');
    }
}
