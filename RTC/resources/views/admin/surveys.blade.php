<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Surveys</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
@include('admin.jsandcss')
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
  @include('admin.includes.header')
  @include('admin.includes.sidemenu')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Surveys
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Surveys</li>
      </ol>
    </section>

    <!------------------Modal----------------->
    <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="panel panel-primary">
                <div class="panel-heading" id="result_class_name">
                    Kết quả đánh giá lớp
                </div>

                  <div class="panel-body">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="col-md-1">STT</th>
                          <th class="col-md-5">Tiêu chí</th>
                          <th class="col-md-1">M</th>
                          <th class="col-md-1">STD</th>
                          <th class="col-md-1">M1</th>
                          <th class="col-md-1">STD1</th>
                          <th class="col-md-1">M2</th>
                          <th class="col-md-1">STD2</th>
                        </tr>
                      </thead>
                      <tbody id="result_list">
                        <tr>
                          <td>1</td>
                          <td>Giảng đường đáp ứng yêu cầu môn học</td>
                          <td>4.08</td>
                          <td>1.23</td>
                          <td>4.06</td>
                          <td>1.14</td>
                          <td>4.02</td>
                          <td>1.16</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Các trang tiết bị tại giảng đượng đáp ứng yêu cầu giảng dạy</td>
                          <td>4.08</td>
                          <td>1.23</td>
                          <td>4.06</td>
                          <td>1.14</td>
                          <td>4.02</td>
                          <td>1.16</td>
                        </tr>
                      </tbody>
                    </table>
                    <div>
                      <p>Gi chú:</p>
                      <ul>
                        <li>M: Giá trị trung bình của các tiêu chí theo lớp học phần</li>
                        <li>STD: Độ lệch chuẩn của các tiêu chí theo lớp học phần</li>
                        <li>M1: Giá trị trung bình các tiêu chí dựa trên dữ liệu phản hồi của sinh viên cho các giảng viên giảng dạy cùng môn học với thầy/cô</span></li>
                        <li>STD1: Độ lệch chuẩn các tiêu chí dựa trên dữ liệu phản hồi của sinh viên cho các giảng viên giảng dạy cùng môn học với thầy/cô</span></li>
                        <li>M2: Giá trị trung bình các tiêu chí dựa trên dữ liệu phản hồi của sinh viên về các môn học thầy/cô thực hiện giảng dạy</span></li>
                        <li>M2: Độ lệch chuẩn các tiêu chí dựa trên dữ liệu phản hồi của sinh viên về các môn học thầy/cô thực hiện giảng dạy</span></li>
                      </ul>
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-----------------END modal--------------->

    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Surveys List</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped" id = "table1">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>Survey Name</th>
                  <th>Participating Class</th>
                  <th>Completed Surveys</th>
                </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Survey Name</th>
                    <th>Participating Class</th>
                    <th>Completed Surveys</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>

        </div>

    </section>
  </div>
  @include('admin.includes.footer')

</div>
<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
var tabledata;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var original_table_data = "";
var original_surveys_result_point = "";
var original_schema_list = "";
function set_original_table_data(data,data2,data3){
  original_table_data = data;
  original_surveys_result_point = data2;
  original_schema_list = data3;
}

$(document).ready(function(){
  $.ajax({
     type:'POST',
     url:'/admin/surveys/get_results',
     success:function(data){
       //console.log(data);
       //survey = JSON.parse(data.survey_results);
       var survey = JSON.parse(data.survey_results);
       var resultPoint = JSON.parse(data.resultPoint);
       var schemaList = JSON.parse(data.schema);

      //console.log(data.resultPoint);
      //console.log(schemaList);

       set_original_table_data(survey,resultPoint,schemaList);
       filltable(survey, resultPoint);
     },
     error: function(a, b) {
       console.log(a);
       alert("An Error occured! Please refresh this page");
     }
  });
});

function filltable(data, resultPoint){
  var i;
  var rows='';
  for(i = 0;i<data.length;i++){
    rows += '<tr id="row_num_' + data[i].id + '" onclick="showModal(' + original_table_data[i].id + ');"">';
    rows += '<td id="stt_num_' + i + '">' + (i+1) + '</td>';
    rows += '<td id="title_row_' + data[i].id + '">' + data[i].title + '</td>';
    rows += '<td id="class_name_row_' + data[i].id + '">' + data[i].class_name + '</td>';
    rows += '<td id="count_row_' + data[i].id + '">' + data[i].count + ' sinh viên'  +'</td>';
    rows += '</tr>';
  }
  $('#table1').DataTable().destroy();
  $("#table_body").html(rows);
  $('#table1').DataTable().draw();
}

function showModal(id) {
  var currentClass = "";
  var result = [];
  for(var i = 0;i<original_surveys_result_point.length;i++){
    if(original_surveys_result_point[i].class_id == id){
      currentClass = original_surveys_result_point[i];
      result.push(original_surveys_result_point[i]);
    }
  }

  var schemaBody = "";
  for(var i = 0;i<original_schema_list.length;i++){
    if(original_schema_list[i].id == currentClass.schema_id){
      schemaBody = JSON.parse(original_schema_list[i].body);
    }
  }
  fillResultTable(schemaBody, result);

  $('#result_class_name').html($('#class_name_row_' + id).html());
  $('#myModal').modal();

}

function fillResultTable(schema, result){
  var i;
  var rows='';
  var array = getQuestion(schema);
  for(i = 0;i<array.length;i++){
      rows += '<tr id="row_num_' + (i+1) + '">';
      rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
      rows += '<td id="question_row_' + (i+1) + '">' + array[i] + '</td>';
      rows += '<td id="dtb_row_' + (i+1) + '">' + avgPoint(result, i).toFixed(2) + '</td>';
      rows += '<td id="ps_row_' + (i+1) + '">' + phuongSai(result, i).toFixed(2) + '</td>';
      rows += '<td id="dtb_row_' + (i+1) + '">' + avgPoint(result, i).toFixed(2) + '</td>';
      rows += '<td id="ps_row_' + (i+1) + '">' + phuongSai(result, i).toFixed(2) + '</td>';
      rows += '<td id="dtb_row_' + (i+1) + '">' + avgPoint(result, i).toFixed(2) + '</td>';
      rows += '<td id="ps_row_' + (i+1) + '">' + phuongSai(result, i).toFixed(2) + '</td>';
      rows += '</tr>';
  }
$("#result_list").html(rows);
}

function avgPoint(data, id) { // tính điểm trung bình cho từng câu hỏi theo mã
  var sum = 0;
  for (var i = 0; i < data.length; i++) {
    var array = JSON.parse(data[i].result);
    //console.log(array);
    sum += parseInt(array.r[id]);
  }
  if (isNaN(sum/data.length)) {
    return 0;
  }
  return sum/data.length;
}

function phuongSai(data, id) { // tính phương sai
    var phuongSai;
    var sumPhuongSai = 0;
    var avg = avgPoint(data, id);

    for (var i = 0; i < data.length; i++) {
      var array = JSON.parse(data[i].result);
      //console.log(array);
      sumPhuongSai += Math.pow(array.r[id] - avg, 2);

    }

    console.log(sumPhuongSai/(data.length-1));

    if (isNaN(Math.sqrt(sumPhuongSai/(data.length-1)))) {
      return 0;
    }

    return Math.sqrt(sumPhuongSai/(data.length-1));
}

function getQuestion(data) { // lấy toàn bộ các câu hỏi về một mảng thống nhất
  console.log(data);
  var array = [];
  for (var i = 0; i < data.content.length; i++) {
    array = array.concat(data.content[i].questions);
    }
    //console.log(array);
    return array;
  }


</script>

</body>
</html>
