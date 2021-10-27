<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'gallery_name', 'gallery_image', 'gallery_product_id'
    ];
    protected $primaryKey = 'gallery_id';
 	protected $table = 'gallery';
}
