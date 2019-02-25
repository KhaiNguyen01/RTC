<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Students</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
@include('admin.jsandcss')
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form onsubmit="editTeacher();">
              <input class="form-control" type="hidden" name="id" id="edid" required>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="edname" required>
              </div>

              <div class="form-group">
                <label for="cpu">Email</label>
                <input class="form-control" type="email" name="email" id="edemail" required>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" value="submit" id="edit_submit" class="btn btn-default">
            </div>
          </form>
          </div>
        </div>
      </div>
<div class="wrapper">
  @include('admin.includes.header')
  @include('admin.includes.sidemenu')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Students
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
      </ol>
    </section>

    <!---------------------------------context menu----------------------------------------->

          <div id="contextmenu" class="context-menu">
            <ul>
              <li id="edit_link" data-toggle="modal" data-target="#myModal">Edit this one</li>
              <li id="delete_link">Delete this one</li>
            </ul>
          </div>

    <!---------------------------------END context menu----------------------------------------->

    <section class="content">
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Students List</h3>
            </div>
            <div class="box-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>MSSV</th>
                  <th>Students Name</th>
                  <th>Students Email</th>
                </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>MSSV</th>
                    <th>Students Name</th>
                    <th>Students Email</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Add a student</h3>
            </div>
            <div class="box-body">
              <form onsubmit="insertStudent();">
                <div class="form-group">
                  <label for="teacher_name">Mssv: </label>
                  <input class="form-control" type="number" min="0" name="teacher_name" required id="insmssv" placeholder="MSSV">
                </div>
                <div class="form-group">
                  <label for="teacher_email">Student Name: </label>
                  <input class="form-control" type="text" name="teacher_email" required id="insname" placeholder="Student Name">
                </div>
                <div class="form-group">
                  <label for="teacher_pwd">Student Password: </label>
                  <input class="form-control" type="password" name="teacher_pwd" required id="inspwd" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="submit" value="sumbit" class="btn btn-info pull-right">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Add students with Excel file</h3>
            </div>
            <div class="box-body">
              <form id="excelForm" onsubmit="insertWithExcel();" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="teacher_name">Excel file: </label>
                  <input class="form-control" type="file" name="file" accept=".xls,.xlsx" required>
                </div>
                <div class="form-group">
                  <input type="submit" value="sumbit" class="btn btn-info pull-right">
                </div>
              </form>
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
     url:'/admin/students/list',
     success:function(data){
       //console.log(data);
       data = JSON.parse(data.students);
       set_original_table_data(data);
       var rows='';
       for(var i = 0;i<data.length;i++){
         rows += '<tr id="row_num_' + data[i].id + '" oncontextmenu="return showcontextmenu(' + original_table_data[i].id + ');"">';
         rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
         rows += '<td id="mssv_row_' + data[i].id + '">' + data[i].mssv + '</td>';
         rows += '<td id="name_row_' + data[i].id + '">' + data[i].name + '</td>';
         rows += '<td id="email_row_' + data[i].id + '">' + data[i].email + '</td>';
         rows += '</tr>';
       }
       $("#table_body").html(rows);
       $('#table').DataTable();
     },
     error: function() {
       alert("An Error occured! Please refresh this page");
     }
  });
});

function filltable(data){
  var i;
  var rows='';
  for(i = 0;i<data.length;i++){
    rows += '<tr id="row_num_' + data[i].id + '" oncontextmenu="return showcontextmenu(' + original_table_data[i].id + ');"">';
    rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
    rows += '<td id="mssv_row_' + data[i].id + '">' + data[i].mssv + '</td>';
    rows += '<td id="name_row_' + data[i].id + '">' + data[i].name + '</td>';
    rows += '<td id="email_row_' + data[i].id + '">' + data[i].email + '</td>';
    rows += '</tr>';
  }
$('#table').DataTable().destroy();
$("#table_body").html(rows);
$('#table').DataTable().draw();
}

</script>
<script>
var contextmenu = document.getElementById('contextmenu');
window.onclick = hidecontextmenu;

function showcontextmenu(id){
  $('#edit_link').attr('onclick','fillTeacherModal(' + id + ');');
  $('#delete_link').attr('onclick','deleteTeacher(' + id + ');');
  contextmenu.style.display = "block";
  contextmenu.style.left = event.pageX + 'px';
  contextmenu.style.top = event.pageY + 'px';
  return false;
  }
  function hidecontextmenu(){
    contextmenu.style.display = 'none';
  }
  function fillTeacherModal(id){
    var current_teacher;
    for(var i = 0;i<original_table_data.length;i++){
      if(original_table_data[i].id == id){
        current_teacher = original_table_data[i];
        break;
      }
    }
    $('#edid').val(current_teacher.id);
    $('#edname').val(current_teacher.name);
    $('#edemail').val(current_teacher.email);
  }

  function insertWithExcel(){
    event.preventDefault();
    $.ajax({
       type:'POST',
       url:'/admin/students/excel',
       dataType:'json',
       processData: false,
       contentType: false,
       data:new FormData($("#excelForm")[0]),
       success:function(data){
         //console.log(data);
         $("#excelForm").trigger("reset");
         tabledata = JSON.parse(data.students);
         set_original_table_data(tabledata);
          filltable(tabledata);
       },
       error: function() {
         $("#excelForm").trigger("reset");
         alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
       }
    });
  }

  function insertStudent(){
    event.preventDefault();
    var name = $('#insname').val();
    var mssv = $('#insmssv').val();
    var pwd = $('#inspwd').val();
    if(name != "" && mssv != "" && pwd != ""){
      $('#insname').val("");
      $('#insmssv').val("");
      $('#inspwd').val("");
        $.ajax({
           type:'POST',
           url:'/admin/students/insert',
           data:{
             name : name,
             mssv : mssv,
             pwd : pwd
           },
           success:function(data){
             //console.log(data);
             tabledata = JSON.parse(data.students);
             set_original_table_data(tabledata);
              filltable(tabledata);
           },
           error: function() {
             alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
           }
        });
    }
    else{
      alert("Please enter validate value.");
    }
  }

  function editTeacher(){
    event.preventDefault();
    var id = $('#edid').val();
    var name = $('#edname').val();
    var email = $('#edemail').val();
    if(name != "" && email != "" && id != ""){
      var cnf = confirm("Do you really want change this student's information?");
      if(cnf == true){
        $('#myModal').modal('hide');
        $('#edid').val("");
        $('#edname').val("");
        $('#edemail').val("");
        $.ajax({
           type:'POST',
           url:'/admin/students/edit',
           data:{
             id: id,
             name : name,
             email : email
           },
           success:function(data){
             //console.log(data);
             tabledata = JSON.parse(data.students);
             set_original_table_data(tabledata);
              filltable(tabledata);
           },
           error: function() {
             alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
           }
        });
      }
    }
    else{
      alert("Please enter validate value.");
    }
  }

  function deleteTeacher(id){
    var current_teacher;
    for(var i = 0;i<original_table_data.length;i++){
      if(original_table_data[i].id == id){
        current_teacher = original_table_data[i];
        break;
      }
    }
    var conf = confirm("Do you really want to permanently delete " + current_teacher.name + "? This cannot be undone!");
    if(conf == true){
      $.ajax({
         type:'POST',
         url:'/admin/students/delete',
         data:{
           id: id
         },
         success:function(data){
           //console.log(data);
           tabledata = JSON.parse(data.students);
           set_original_table_data(tabledata);
            filltable(tabledata);
         },
         error: function() {
           alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
         }
      });
    }
  }
</script>
</body>
</html>
