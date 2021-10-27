<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'name_quanhuyen', 'type', 'matp'
    ];
    protected $primaryKey = 'maqh';
 	protected $table = 'quanhuyen';
}
