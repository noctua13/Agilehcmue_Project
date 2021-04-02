<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}