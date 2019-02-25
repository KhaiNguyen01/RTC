<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class teacher_routing_controller extends Controller
{
    public function teacherview(){
      if(session("teacher_id")){
        return view('teachers.home');
      }
      else{
        return view('teachers.login');
      }
    }

    public function classview($class_id){
      if(session("teacher_id")){
        $class = DB::table('classes')->where('id',$class_id)->first();
        $class_name = $class->class_name;
        session(['current_class' => $class_id]);
        return view('teachers.class',['class_name'=>$class_name]);
      }
      else{
        return view('teachers.login');
      }
    }

    public function login(Request $req){

      $input_username = $req->input('username');
      $input_password = $req->input('password');

      $password_check = DB::table('teachers')->select('*')
                                   ->where('usr','=',$input_username)
                                   ->first();
      if($password_check && sha1($input_password) == $password_check->pwd){
        session(['teacher_id' => $password_check->id]);
        session(['teacher_name' => $password_check->name]);
        return redirect("/teacher");
      }
      else{
        return redirect("/teacher")->with('error','true');
      }

  }

    public function logout(){
      session()->flush();
      return redirect("/teacher");
    }
}
