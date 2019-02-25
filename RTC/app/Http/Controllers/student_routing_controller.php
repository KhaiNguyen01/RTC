<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class student_routing_controller extends Controller
{
  public function home(){
    return view('students.home');
  }

  public function my(){
    if(session("student_id")){
      return view('students.home');
    }
    else{
      return view('students.login');
    }
  }

  public function loginview(){
    return view('students.login');
  }

  public function login(Request $req){

    $input_username = $req->input('username');
    $input_password = $req->input('password');

    $password_check = DB::table('students')->select('*')
                                 ->where('mssv','=',$input_username)
                                 ->first();
    if($password_check && sha1($input_password) == $password_check->pwd){
      session(['student_id' => $password_check->id]);
      session(['student_mssv' => $password_check->mssv]);
      session(['student_name' => $password_check->name]);
      return redirect("/my");
    }
      return redirect("/login")->with('error','true');
}

  public function classrateview($class_id){
    if(!session("student_id")){
      return redirect('/');
    }

    $StudentIsInClass = DB::table('student_class')->where('student_id',session('student_id'))->where('class_id',$class_id)->first();
    if($StudentIsInClass){
      $class = DB::table('classes')->join('teachers','teachers.id','=','classes.teacher_id')->where('classes.id',$class_id)->first();
      $survey_schema = DB::table('survey_schemas')->join('surveys','surveys.schema_id','=','survey_schemas.id')->where('surveys.class_id',$class_id)->first();

      $class_name = $class->class_name;
      $class_teacher = $class->name;
      $schema = json_decode($survey_schema->body);
      session(['current_class' => $class_id]);
      $result = null;
      $resultIfExist = DB::table('survey_results')->join('surveys','survey_results.survey_id','=','surveys.id')->where('class_id',$class_id)->where('student_id',session('student_id'))->where('survey_id',$survey_schema->id)->first();
      if($resultIfExist != null){
        $result_content = json_decode($resultIfExist->result);
        $result = $result_content->r;
      }
      return view('students.rate_the_course',['class_name'=>$class_name,'class_teacher'=>$class_teacher,'schema_content'=>$schema->content,'result'=>$result]);
    }
    else{
      return redirect('/my');
    }

  }

  public function logout(){
    session()->flush();
    return redirect("/");
  }
}
