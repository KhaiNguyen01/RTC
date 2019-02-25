<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = "classes";
    protected $fillable = array('class_name','teacher_id');
    public $timestamps = false;

    public function teacher(){
      return $this->belongsTo('App\Teacher', 'teacher_id');
    }
}
