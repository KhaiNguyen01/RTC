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

class student_data_controller extends Controller {
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
      $classes = $this->ClassModel::all()->toJson();
        return response()->json(['courses'=>$classes]);
    }

    public function getCoursesByStudent(){
      $classes = $this->StudentClassModel->with('class')->where('student_id',session("student_id"))->get()->toJson();
      return response()->json(['courses'=>$classes]);
    }

    public function rate(Request $req){
      //echo '<pre>';
      $survey_schema = DB::table('survey_schemas')
                          ->join('surveys','surveys.schema_id','=','survey_schemas.id')
                          ->where('surveys.class_id',session('current_class'))
                          ->first(); // find the survey schema to this rating result
      //var_dump($survey_schema);
      ///////////////////////////////////////////////////////////
      //  example of a survey schema
      //   {
    	//   "content": [{
    	//   	"title": "category title 0",
    	//   	"questions": ["question 0", "question 1"]
    	//   }, {
    	//   	"title": "category title 1",
    	//   	"questions": ["question 2", "question 3", "question 4", "question 5", "question 6"]
    	//   }, {
    	//   	"title": "category title 2",
    	//   	"questions": ["question 7", "question 8", "question 9"]
    	//   }]
      //   }
      ///////////////////////////////////////////////////////////
      $schema = json_decode($survey_schema->body);// parse json form into array
      $schema_content = $schema->content; // get the schemas body and its content
      // build the result in JSON format
      // exp: {"r":["1","2","3","4","5","4","3","2","1","2"]}
      // r is an array of all the answers to each question in the surveys, ranging from 1 - 5
      $resultInJson = '{"r":[';// those first characters of the json string
      for($i = 0;$i<sizeof($schema_content);$i++){//to each category
        $qs = $schema_content[$i]->questions;//get the questions array to each category
        for($j = 0;$j<sizeof($qs);$j++){//to each question in this category
          //q_[i]_[j] :
          //i is the category position
          //j is the question position
          $resultInJson .= '"' . $req->input('q_'.$i.'_'.$j) .'"';
          if($j+1 != sizeof($qs) || $i+1 != sizeof($schema_content)){
            $resultInJson .=',';// put "," after each question answer, dont put "," if it's the last question
          }
        }
      }
      $resultInJson .="]}";// end of the json string
      // save the result in the database
      $this->SurveyResultModel->student_id = session('student_id');
      $this->SurveyResultModel->survey_id = $survey_schema->id;
      $this->SurveyResultModel->result = $resultInJson;
      $this->SurveyResultModel->save();
      //and redirect back
      $curClass = session('current_class');
      session()->forget('current_class');
      return redirect('/my/'.$curClass);
    }

    public function changePassword(){
      $return_text = "";
      $data = request()->all();
        $old = $data['old'];
        $new = $data['new'];
        $password_check = DB::table('students')->select('*')
                                     ->where('mssv','=',session('student_mssv'))
                                     ->first();
        if($password_check->pwd == sha1($old)){
          $pwd = sha1($new);
          $this->studentModel = $this->studentModel::find(session('student_id'));
          $this->studentModel->pwd = $pwd;
          $this->studentModel->save();
          $return_text = "Change password successfully.";
        }
        else{
          $return_text = "An Error occured! Please make sure your input is valid!";
        }

        return response()->json(['text'=>$return_text]);
    }
}
