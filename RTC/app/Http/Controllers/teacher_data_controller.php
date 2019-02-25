<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Teacher;
use App\Survey_schema;
use App\ClassModel;
use App\StudentClass;
use App\Survey;
use App\Survey_result;
use DB;

class teacher_data_controller extends Controller {
  private $table_admin = "admin";
  private $table_classes = "classes";
  private $table_students = "students";
  private $table_teachers = "teachers";
  private $table_student_class = "student_class";
  private $table_surveys = "surveys";
  private $table_survey_schema = "survey_schema";
  private $table_surveys_results = "survey_results";
  private $teacherModel;
  private $studentModel;
  private $schemaModel;
  private $ClassModel;
  private $StudentClassModel;
  private $SurveyModel;
  private $SurveyResultModel;

  public function __construct(){
    $this->teacherModel = new Teacher;
    $this->studentModel = new Student;
    $this->schemaModel = new Survey_schema;
    $this->ClassModel = new ClassModel;
    $this->StudentClassModel = new StudentClass;
    $this->SurveyModel = new Survey;
    $this->SurveyResultModel = new Survey_result;
  }

  public function getAllCourses(){
    $classes = $this->ClassModel->where('teacher_id',session("teacher_id"))->get()->toJson();
    return response()->json(['courses'=>$classes]);
  }

  public function getClassData(){
    $students = $this->StudentClassModel->with('student')->where('class_id',session('current_class'))->get()->toJson();
    $survey_schema = DB::table('surveys')->join('survey_schemas','surveys.schema_id','=','survey_schemas.id')->where('surveys.class_id',session('current_class'))->first();
    $schema = $survey_schema->body;
    $surveyResults = DB::table('surveys')->join('survey_results','surveys.id','=','survey_results.survey_id')->where('surveys.class_id',session('current_class'))->get()->toJson();
    return response()->json(['students'=>$students,'rawResult'=>$surveyResults,'schema'=>$schema]);
  }

  public function changePassword(){
    $return_text = "";
    $data = request()->all();
      $old = $data['old'];
      $new = $data['new'];
      $password_check = DB::table('teachers')->select('*')
                                   ->where('id','=',session('teacher_id'))
                                   ->first();
      if($password_check->pwd == sha1($old)){
        $pwd = sha1($new);
        $this->teacherModel = $this->teacherModel::find(session('teacher_id'));
        $this->teacherModel->pwd = $pwd;
        $this->teacherModel->save();
        $return_text = "Change password successfully.";
      }
      else{
        $return_text = "An Error occured! Please make sure your input is valid!";
      }

      return response()->json(['text'=>$return_text]);
  }
}
