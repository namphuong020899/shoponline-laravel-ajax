<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $table = "reviews";
  	// public $timestamps = false;

  	protected $primaryKey = 'review_id';
  	protected $fillable = [
    	'rating','comment','review_detail_id'
  	];
}
