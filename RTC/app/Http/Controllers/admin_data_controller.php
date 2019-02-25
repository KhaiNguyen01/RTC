<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Maatwebsite\Excel\Excel;
use App\Imports\StudentsImport;
use App\Imports\TeachersImport;
use App\Imports\ClassImport;
use App\Student;
use App\Teacher;
use App\Survey_schema;
use App\ClassModel;
use App\StudentClass;
use App\Survey;
use App\Survey_result;

class admin_data_controller extends Controller {
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
    private $SurveyResult;
    private $schema;

    public function __construct(){
      $this->teacherModel = new Teacher;
      $this->studentModel = new Student;
      $this->schemaModel = new Survey_schema;
      $this->ClassModel = new ClassModel;
      $this->StudentClassModel = new StudentClass;
      $this->SurveyModel = new Survey;
      $this->SurveyResult = new Survey_result;
    }

    public function dashboard(){
      $teachers = $this->teacherModel::all()->toJson();
      $survey_results = DB::table('survey_schemas')
                            ->join('surveys', 'survey_schemas.id', '=', 'surveys.schema_id')
                            ->join('classes', 'classes.id', '=', 'surveys.class_id')
                            ->join('survey_results', 'survey_results.survey_id', '=', 'surveys.id')
                            ->select(DB::raw('classes.id, title, classes.class_name as class_name, count(survey_results.id) as count'))
                            ->groupBy('classes.id')
                            ->get()->toJson();
      return response()->json(['survey_results'=>$survey_results, 'teachers'=>$teachers]);
    }

    public function get_survey_results(){
      $schema = DB::table('survey_schemas')->get()->toJson();

      $surveyResultPoint = DB::table('survey_results')
                            ->join('surveys', 'surveys.id', '=', 'survey_results.survey_id')
                            ->get()->toJson();

      $survey_results = DB::table('survey_schemas')
                            ->join('surveys', 'survey_schemas.id', '=', 'surveys.schema_id')
                            ->join('classes', 'classes.id', '=', 'surveys.class_id')
                            ->join('survey_results', 'survey_results.survey_id', '=', 'surveys.id')
                            ->select(DB::raw('classes.id, title, classes.class_name as class_name, count(survey_results.id) as count'))
                            ->groupBy('classes.id')
                            ->get()->toJson();

      return response()->json(['survey_results'=>$survey_results, 'schema'=>$schema, 'resultPoint'=>$surveyResultPoint]);
    }

    public function get_students(){
      $students = $this->studentModel::all()->toJson();
      return response()->json(['students'=>$students]);
    }

    public function get_teachers(){
      $teachers = $this->teacherModel::all()->toJson();
      return response()->json(['teachers'=>$teachers]);
    }

    public function get_schemas(){
      $schemas = $this->schemaModel::all()->toJson();
      return response()->json(['schemas'=>$schemas]);
    }

    public function insert_teacher(){
      $data = request()->all();
      $usr = $data['usr'];
      $pwd = sha1($data['pwd']);
      $name = $data['name'];
      $email = $data['email'];

      $this->teacherModel->name = $name;
      $this->teacherModel->email = $email;
      $this->teacherModel->usr = $usr;
      $this->teacherModel->pwd = $pwd;
      $this->teacherModel->save();

      return $this->get_teachers();
    }

    public function insert_teachers_by_excel(){
      $data = request()->all();
      if(isset($data['file'])){
        \Excel::import(new TeachersImport,$data['file']);
        return $this->get_teachers();
      }
    }

    public function edit_teacher(){
      $data = request()->all();
      $id = $data['id'];
      $name = $data['name'];
      $email = $data['email'];

      $this->teacherModel = $this->teacherModel::find($id);
      $this->teacherModel->name = $name;
      $this->teacherModel->email = $email;
      $this->teacherModel->save();

      return $this->get_teachers();
    }

    public function delete_teacher(){
      $data = request()->all();
      $id = $data['id'];

      $this->teacherModel = $this->teacherModel::find($id);
      $this->teacherModel->delete();

      return $this->get_teachers();
    }

    public function insert_student(){
      $data = request()->all();
      $mssv = $data['mssv'];
      $pwd = sha1($data['pwd']);
      $name = $data['name'];
      $email = $mssv . "@uet.vnu.edu.vn";

      $this->studentModel->name = $name;
      $this->studentModel->email = $email;
      $this->studentModel->mssv = $mssv;
      $this->studentModel->pwd = $pwd;
      $this->studentModel->save();

      return $this->get_students();
    }

    public function insert_students_by_excel(){
      $data = request()->all();
      if(isset($data['file'])){
        \Excel::import(new StudentsImport,$data['file']);
        return $this->get_students();
      }
    }

    public function edit_student(){
      $data = request()->all();
      $id = $data['id'];
      $name = $data['name'];
      $email = $data['email'];

      $this->studentModel = $this->studentModel::find($id);
      $this->studentModel->name = $name;
      $this->studentModel->email = $email;
      $this->studentModel->save();

      return $this->get_students();
    }

    public function delete_student(){
      $data = request()->all();
      $id = $data['id'];

      $this->studentModel = $this->studentModel::find($id);
      $this->studentModel->delete();

      return $this->get_students();
    }

    public function insert_schema(){
      $title = "Untitled Survey";
      $body = '{"content" : []}';
      $this->schemaModel->title = $title;
      $this->schemaModel->body = $body;
      $this->schemaModel->save();

      return $this->get_schemas();
    }

    public function edit_schema(){
      $data = request()->all();
      $id = $data['id'];
      $title = $data['title'];
      $body = $data['body'];

      $this->schemaModel = $this->schemaModel::find($id);
      $this->schemaModel->title = $title;
      $this->schemaModel->body = $body;
      $this->schemaModel->save();

      return $this->get_schemas();
    }

    public function delete_schema(){
      $data = request()->all();
      $id = $data['id'];

      $this->schemaModel = $this->schemaModel::find($id);
      $this->schemaModel->delete();

      return $this->get_schemas();
    }

    public function get_classes_data(){
      $schemas = $this->schemaModel::all()->toJson();
      $classes = $this->ClassModel->with('teacher')->get()->toJson();

        return response()->json(['schemas'=>$schemas,'classes'=>$classes]);
    }

    public function insert_classes(){
      $data = request()->all();
      if(isset($data['file'])){
        $def_schemal = $data['def_schema'];
        $array = (new ClassImport)->toArray($data['file']); //Import Excel file into $array
        $ExcelSheet = $array[0]; //select the first sheet in the excel file
        if($ExcelSheet != null){
          $class_name = $ExcelSheet[9][2] . " " .$ExcelSheet[8][2]; //exp: Toan Roi Rac + INt2203
          $teacher_name = $ExcelSheet[6][2];
          $students = Array();  //temporary list of students
          $index = 11; //row index where student list starts
          while(1){
            if($ExcelSheet[$index][0]!=null && $ExcelSheet[$index][1]!=null && $ExcelSheet[$index][2]!=null){ //stt!=null && mssv != null && name!=null
              array_push($students,$ExcelSheet[$index][1]); //add into temporary list
              $index++;
            }
            else{ //if encounter an empty row, stop reading
              break;
            }
          }
            $teacher = $this->teacherModel->where('name',$teacher_name)->first(); //get the teacher data
            if($teacher != null){ //if this teacher already in database
              $classExistOrNot = $this->ClassModel->where('class_name',$class_name)->where('teacher_id',$teacher->id)->first(); //get data of the inputing class
              if($classExistOrNot == null){// if this class haven't been add to database
                $class = $this->ClassModel->create(['class_name'=>$class_name,'teacher_id'=>$teacher->id]);//create new class
                for($i = 0;$i<sizeof($students);$i++){
                  $student = $this->studentModel->where('mssv',$students[$i])->first();// We only have students mssv so we need to get student id based on his mssv
                  $this->StudentClassModel->create(['student_id' => $student->id,'class_id'=>$class->id,'active'=>1]); //create a row in student_class table
                }
                //now add a row to survey table
                  $this->SurveyModel->schema_id = $def_schemal;
                  $this->SurveyModel->class_id = $class->id;
                  $this->SurveyModel->save();
              }
            }
        }
        return $this->get_classes_data();
      }
    }

    public function delete_classes(){
      $data = request()->all();
      $class_id = $data['id'];
      DB::table('classes')->where('id', '=', $class_id)->delete();
      DB::table('student_class')->where('class_id', '=', $class_id)->delete();
      DB::table('surveys')->where('class_id', '=', $class_id)->delete();
      DB::table('surveys')->where('class_id', '=', $class_id)->delete();
      return $this->get_classes_data();
    }

    public function list_student_by_class(){
      $data = request()->all();
      $class_id = $data['id'];
      $students = DB::table('classes')->join('student_class', 'classes.id', '=', 'student_class.class_id')
                          ->join('students', 'students.id', '=', 'student_class.student_id')
                          ->where('classes.id', '=', $class_id)->get()->toJson();

      return response()->json(['students'=>$students]);
    }
}
