<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
	protected $table = "slider";
  public $timestamps = false;

  protected $primaryKey = 'slider_id';
  protected $fillable = [
    'slider_name',  
    'slider_status', 
    'slider_image', 
    'slider_desc',
    'slider_links',
    'slider_sorting'
  ];
}
