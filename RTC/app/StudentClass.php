<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
  protected $table = "student_class";
  protected $fillable = array('student_id','class_id','active');
  public $timestamps = false;

  public function class(){
    return $this->belongsTo('App\ClassModel', 'class_id');
  }

  public function student(){
    return $this->belongsTo('App\Student', 'student_id');
  }
}
