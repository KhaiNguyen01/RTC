<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = array('mssv','name', 'pwd', 'email');
    public $timestamps = false;
}
