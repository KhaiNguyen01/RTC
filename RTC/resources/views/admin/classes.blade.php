<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Classes</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
@include('admin.jsandcss')
<style>
  .row_selected{
    background: #ACFF79;
  }
  #saveOrCancleArea{
    display: none;
  }
  .title_edit_toggle{
    display: none;
  }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include('admin.includes.header')
  @include('admin.includes.sidemenu')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Classes
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Classes</li>
      </ol>
    </section>

    <!---------------------------------context menu----------------------------------------->

          <div id="contextmenu" class="context-menu">
            <ul>
              <li id="delete_link">Delete this one</li>
            </ul>
          </div>

    <!---------------------------------END context menu----------------------------------------->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Add Class with Excel file</h3>
            </div>
            <div class="box-body">
              <form id="excelForm" onsubmit="insertWithExcel();" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="teacher_name">Excel file: </label>
                  <input class="form-control" type="file" name="file" accept=".xls,.xlsx" required>
                </div>
                <div class="form-group">
                  <label for="sel1">Default survey schema:</label>
                  <select name="def_schema" class="form-control" id="def_schema">
                  </select>
                </div>
                <div class="form-group">
                  <input type="submit" value="sumbit" class="btn btn-info pull-right">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Classes List</h3><div class="loader pull-right"></div>
            </div>
            <div class="box-body">
              <table id="table" class="table table-bordered">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>Class Name</th>
                  <th>Teacher</th>
                </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Class Name</th>
                    <th>Teacher</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" id="class_name">Students List of </h3>
            </div>
            <div class="box-body">
              <table id="table2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>MSSV</th>
                  <th>Student Name</th>
                  <th>Email</th>
                </tr>
                </thead>
                <tbody id="table_body2">
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>MSSV</th>
                    <th>Student Name</th>
                    <th>Email</th>
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
function set_original_table_data(data){
  original_table_data = data;
}

$(document).ready(function(){
  $.ajax({
     type:'POST',
     url:'/admin/classes/list',
     success:function(data){
       //console.log(data);
       classesdata = JSON.parse(data.classes);
       set_original_table_data(classesdata);
       var rows='';
       for(var i = 0;i<classesdata.length;i++){
         var firstRowStyle = i==0?'class="row_selected"':"";
         rows += '<tr ' + firstRowStyle + ' id="row_num_' + classesdata[i].id + '" oncontextmenu="return showcontextmenu(' + original_table_data[i].id + ');" onclick="showstudents('+ original_table_data[i].id +')">';
         rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
         rows += '<td id="name_row_' + classesdata[i].id + '">' + classesdata[i].class_name + '</td>';
         rows += '<td id="teacher_row_' + classesdata[i].id + '">' + classesdata[i].teacher.name + '</td>';
         rows += '</tr>';
       }
       $("#table_body").html(rows);
       $('#table').DataTable();
       if(classesdata.length >0){
         showstudents(classesdata[0].id)
       }

      schemasData = JSON.parse(data.schemas);
      var options = "";
      for(var i = 0;i<schemasData.length;i++){
        options += '<option value="' + schemasData[i].id + '">' + schemasData[i].title + '</option>';
      }

      $("#def_schema").html(options);

     },
     error: function(a,b) {
       console.log(a);
       console.log(b);
       alert("An Error occured! Please refresh this page");
     }
  });
});

function showstudents(id){
  $(".row_selected").removeClass("row_selected");
  $("#row_num_" + id).addClass("row_selected");
  $('.loader').css('display','block');
  $.ajax({
     type:'POST',
     url:'/admin/classes/list_student',
     data:{
       id:id
     },
     success:function(data){
       console.log(data);
       students = JSON.parse(data.students);
        fillstudentstable(students);
        $('.loader').css('display','none');
     },
     error: function(a,b) {
       console.log(a);
       console.log(b);
       $('.loader').css('display','none');
       alert("An Error occured!");
     }
  });
}

function fillstudentstable(data){
  $('#class_name').html(data[0].class_name);
  console.log(data);
  var i;
  var rows='';
  for(i = 0;i<data.length;i++){
    rows += '<tr id="st_row_num_' + data[i].id + '">';
    rows += '<td id="st_stt_row_' + (i+1) + '">' + (i+1) + '</td>';
    rows += '<td id="st_name_row_' + data[i].id + '">' + data[i].mssv + '</td>';
    rows += '<td id="st_teacher_row_' + data[i].id + '">' + data[i].name + '</td>';
    rows += '<td id="st_teacher_row_' + data[i].id + '">' + data[i].email + '</td>';
    rows += '</tr>';
  }
  $('#table2').DataTable().destroy();
  $("#table_body2").html(rows);
  $('#table2').DataTable().draw();

}

function filltable(data){
  var i;
  var rows='';
  for(i = 0;i<data.length;i++){
    var firstRowStyle = i==0?'class="row_selected"':"";
    rows += '<tr ' + firstRowStyle + ' id="row_num_' + data[i].id + '" oncontextmenu="return showcontextmenu(' + original_table_data[i].id + ');" onclick="showstudents('+ original_table_data[i].id +')">';
    rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
    rows += '<td id="name_row_' + data[i].id + '">' + data[i].class_name + '</td>';
    rows += '<td id="teacher_row_' + data[i].id + '">' + data[i].teacher.name + '</td>';
    rows += '</tr>';
  }
  $('#table').DataTable().destroy();
  $("#table_body").html(rows);
  $('#table').DataTable().draw();
  if(classesdata.length >0){
    showstudents(classesdata[0].id)
  }


}

</script>
<script>
var contextmenu = document.getElementById('contextmenu');
window.onclick = hidecontextmenu;

function showcontextmenu(id){
  $('#delete_link').attr('onclick','deleteTeacher(' + id + ');');
  contextmenu.style.display = "block";
  contextmenu.style.left = event.pageX + 'px';
  contextmenu.style.top = event.pageY + 'px';
  return false;
  }
  function hidecontextmenu(){
    contextmenu.style.display = 'none';
  }


  function insertWithExcel(){
    event.preventDefault();
    $('.loader').css('display','block');
    $.ajax({
       type:'POST',
       url:'/admin/classes/insert',
       dataType:'json',
       processData: false,
       contentType: false,
       data:new FormData($("#excelForm")[0]),
       success:function(data){
         console.log(data);
         $("#excelForm").trigger("reset");
         tabledata = JSON.parse(data.classes);
         set_original_table_data(tabledata);
          filltable(tabledata);
          $('.loader').css('display','none');
       },
       error: function(a,b) {
         console.log(a);
         console.log(b);
         $('.loader').css('display','none');
         alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
       }
    });
  }

  function deleteTeacher(id){
    var current_teacher;
    for(var i = 0;i<original_table_data.length;i++){
      if(original_table_data[i].id == id){
        current_teacher = original_table_data[i];
        break;
      }
    }
    var conf = confirm("Do you really want to permanently delete " + current_teacher.class_name + "? This cannot be undone!");
    if(conf == true){
      $.ajax({
         type:'POST',
         url:'/admin/classes/delete',
         data:{
           id: id
         },
         success:function(data){
           tabledata = JSON.parse(data.classes);
           set_original_table_data(tabledata);
            filltable(tabledata);
         },
         error: function(a,b) {
           console.log(a);
           console.log(b);
           alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
         }
      });
    }
  }
</script>
</body>
</html>
