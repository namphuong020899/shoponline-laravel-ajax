<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'id_user', 'id_product','wish_status'
    ];
    protected $primaryKey = 'id_wishlist';
 	protected $table = 'wishlist';

}
