<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'customer_name', 'customer_address', 'customer_phone','customer_email','customer_note','customer_payment'
    ];
    protected $primaryKey = 'customer_id';
 	protected $table = 'customers_order';
}
