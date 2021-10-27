<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'brand_name', 'brand_slug', 'brand_desc','brand_status','brand_sorting'
    ];
    protected $primaryKey = 'brand_id';
 	protected $table = 'brand';

    public function brand(){
    	return $this->hasMany('App\Products','brand_id');
    }
}
