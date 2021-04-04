<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];

 //  public function procate() {
	// 	return $this->belongsTo(Procate::class, 'procate_id', 'id');
 //  }
  
 //  public function probrand() {
	// 	return $this->belongsTo(Probrand::class, 'brand_id', 'id');
	// }
}