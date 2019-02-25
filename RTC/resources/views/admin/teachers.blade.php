<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teachers</title>
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
        Teachers
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Teachers</li>
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
              <h3 class="box-title">Teachers List</h3>
            </div>
            <div class="box-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>Teacher Name</th>
                  <th>Teacher Email</th>
                </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Teacher Name</th>
                    <th>Teacher Email</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Add a teacher</h3>
            </div>
            <div class="box-body">
              <form onsubmit="insertTeacher();">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="teacher_name">Teacher Name: </label>
                  <input class="form-control" type="text" name="teacher_name" required id="insname" placeholder="Teacher's Name">
                </div>
                <div class="form-group">
                  <label for="teacher_email">Teacher Email: </label>
                  <input class="form-control" type="email" name="teacher_email" required id="insemail" placeholder="Teacher's Email">
                </div>
                <div class="form-group">
                  <label for="teacher_usr">Teacher Username: </label>
                  <input class="form-control" type="text" name="teacher_usr" required id="insusr" placeholder="Username">
                </div>
                <div class="form-group">
                  <label for="teacher_pwd">Teacher Password: </label>
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
              <h3 class="box-title">Add teachers with Excel file</h3>
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
     url:'/admin/teachers/list',
     success:function(data){
       //console.log(data);
       data = JSON.parse(data.teachers);
       set_original_table_data(data);
       var rows='';
       for(var i = 0;i<data.length;i++){
         rows += '<tr id="row_num_' + data[i].id + '" oncontextmenu="return showcontextmenu(' + original_table_data[i].id + ');"">';
         rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
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
       url:'/admin/teachers/excel',
       dataType:'json',
       processData: false,
       contentType: false,
       data:new FormData($("#excelForm")[0]),
       success:function(data){
         //console.log(data);
         $("#excelForm").trigger("reset");
         tabledata = JSON.parse(data.teachers);
         set_original_table_data(tabledata);
          filltable(tabledata);
       },
       error: function() {
         alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
       }
    });
  }

  function insertTeacher(){
    event.preventDefault();
    var name = $('#insname').val();
    var email = $('#insemail').val();
    var usr = $('#insusr').val();
    var pwd = $('#inspwd').val();
    if(name != "" && email != "" && usr != "" && pwd != ""){
      $('#insname').val("");
      $('#insemail').val("");
      $('#insusr').val("");
      $('#inspwd').val("");
        $.ajax({
           type:'POST',
           url:'/admin/teachers/insert',
           data:{
             name : name,
             email : email,
             usr : usr,
             pwd : pwd
           },
           success:function(data){
             //console.log(data);
             tabledata = JSON.parse(data.teachers);
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
      var cnf = confirm("Do you really want change this teacher's information?");
      if(cnf == true){
        $('#myModal').modal('hide');
        $('#edid').val("");
        $('#edname').val("");
        $('#edemail').val("");
        $.ajax({
           type:'POST',
           url:'/admin/teachers/edit',
           data:{
             id: id,
             name : name,
             email : email
           },
           success:function(data){
             //console.log(data);
             tabledata = JSON.parse(data.teachers);
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
         url:'/admin/teachers/delete',
         data:{
           id: id
         },
         success:function(data){
           //console.log(data);
           tabledata = JSON.parse(data.teachers);
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
