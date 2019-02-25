<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
  protected $fillable = array('schema_id','class_id');
  public $timestamps = false;
}
