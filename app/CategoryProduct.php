<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'category_sorting', 'category_name', 'slug_category_product','category_desc','category_status'
    ];
    // protected $guarded = [];
    protected $primaryKey = 'category_id';
 	protected $table = 'category_product';

    public function category(){
    	return $this->hasMany('App\Products','category_id');
    }
}
