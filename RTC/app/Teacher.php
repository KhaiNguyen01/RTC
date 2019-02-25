<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  protected $fillable = array('usr','name', 'pwd', 'email');
  protected $primaryKey = 'id';
  public $timestamps = false;
}
