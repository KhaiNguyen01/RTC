<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Schemas</title>
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
        Schemas
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Schemas</li>
      </ol>
    </section>

    <!---------------------------------context menu----------------------------------------->

          <div id="contextmenu" class="context-menu">
            <ul>
              <li id="delete_link">Delete this one</li>
            </ul>
          </div>
          <div id="contextMenuEditor" class="context-menu">
            <ul>
              <li id="add_question_link" style="display:none">Add a question</li>
              <li id="delete_node_link">Delete this one</li>
            </ul>
          </div>

    <!---------------------------------END context menu----------------------------------------->

    <section class="content">
      <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Schema List</h3>
              <button class="btn btn-primary pull-right" onclick="new_schema();">New Schema</button>
            </div>
            <div class="box-body">
              <table id="table" class="table table-bordered">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>Title</th>
                </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Title</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title editable" id="editor_title"></h3><span class="col-xs-offset-1 title_edit_toggle">Click on any text to edit</span>
              <button id="edit_button" class="pull-right btn btn-success" onclick="startEditing()"><span class="fa fa-pencil"></span> Edit</button>
              <div class="pull-right" id="saveOrCancleArea">
                <button class="btn btn-success" onclick="saveSchema()"><span></span> Save</button>
                <button class="btn btn-danger" onclick="CancelEditor()"><span></span> Cancel</button>
              </div>
            </div>
            <div class="box-body" id="editor_body">
              <div class="panel-group" id="accordion">

              </div>
            </div>
            <div class="box-footer" style="display:none;">
              <button class="btn btn-info" onclick="addQuestionCategory();">
                Add Question Category <span class="fa fa-plus"></span>
              </button>
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
     url:'/admin/schemas/list',
     success:function(data){
       //console.log(data);
       data = JSON.parse(data.schemas);
       set_original_table_data(data);
       var rows='';
       for(var i = 0;i<data.length;i++){
         var firstRowStyle = i==0?'class="row_selected"':"";
         rows += '<tr ' + firstRowStyle + ' id="row_num_' + data[i].id + '" onclick="openEditor(' + original_table_data[i].id + ');"' + ' oncontextmenu="return showcontextmenu(' + original_table_data[i].id + ');">';
         rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
         rows += '<td id="title_row_' + data[i].id + '">' + data[i].title + '</td>';
         rows += '</tr>';
       }
       $("#table_body").html(rows);
       $('#table').DataTable();
       openEditor(data[0].id); // Open default editor with first row data
     },
     error: function() {
       alert("An Error occured! Please refresh this page");
     }
  });
});

function addQuestionCategory(){
  var position = document.getElementById('accordion').childNodes.length;
  $('#accordion').append(NewQuestionCategoryGUI("Unnamed Category",position));
  EditorUI();
}

function addQuestion(parent){
  var position = document.getElementById('collapse' + parent).childNodes.length;
  console.log(document.getElementById('collapse' + parent));
  $('#collapse' + parent).append(NewQuestionGUI("Unnamed Question",parent,position));
  EditorUI();
}
var accordionInnerHtml = "";

function EditorUI(){

  $('#saveOrCancleArea').css('display','block');
  $('.title_edit_toggle').css('display','inline');
  $('#edit_button').css('display','none');
  $('.box-footer').css('display','block');
  var x = $('.editable');
  for(var i = 0;i<x.length;i++){
    x[i].contentEditable = true;
  }
  $('#editor_title').focus();
}

function startEditing(){
  accordionInnerHtml = $("#accordion").html();
  EditorUI();
}

function CancelEditor(){
  $("#accordion").html(accordionInnerHtml);
  CloseEditor();
}

function CloseEditor(){
  $('#saveOrCancleArea').css('display','none');
  $('.title_edit_toggle').css('display','none');
  $('#edit_button').css('display','block');
  $('.box-footer').css('display','none');
  var x = $('.editable');
  for(var i = 0;i<x.length;i++){
    x[i].contentEditable = false;
  }
}

function NewQuestionCategoryGUI(title, position){
  var QuestionCategoryModel = '<div id="c' + position + '" class="panel panel-default">' +
                              '<div class="panel-heading" oncontextmenu="return showcontextmenuEditor(-1,' + position + ');">' +
                              '<h4 class="panel-title">' +
                              '<a class="editable" data-toggle="collapse" data-parent="#accordion"' +
                              ' href="#collapse' + position +
                              '">' + title + '</a>' +
                              '</h4></div>' +
                              '<div id="collapse' + position +
                              '" class="panel-collapse collapse"></div></div>';
  return QuestionCategoryModel;
}

function NewQuestionGUI(text,parentPosition,position){
  var QuestionModel = '<div id="q' + parentPosition  + position + '" class="editable panel-body" oncontextmenu="return showcontextmenuEditor(' +parentPosition+ ','+position+');">' + text +
                      '</div>';
  return QuestionModel;
}
var current_schema;
function openEditor(id){
  CancelEditor();
  $(".row_selected").removeClass("row_selected");
  $("#row_num_" + id).addClass("row_selected");

  for(var i = 0;i<original_table_data.length;i++){
    if(original_table_data[i].id == id){
      current_schema = original_table_data[i];
      break;
    }
  }

  $('#editor_title').html(current_schema.title);
  var schema = {"content" : []};
  if(current_schema.body != ""){
    schema = JSON.parse(current_schema.body);
  }

  $('#accordion').html("");
  for(var i = 0;i<schema.content.length;i++){
    $('#accordion').append(NewQuestionCategoryGUI(schema.content[i].title,i));
    for(var j = 0;j<schema.content[i].questions.length;j++){
      $('#collapse' + i).append(NewQuestionGUI(schema.content[i].questions[j],i,j));
    }
  }

}

function deleteNode(parent, child){
console.log(parent);
  if(parent == -1){
    var acc = document.getElementById("accordion");
    var position = child;
    var c = document.getElementById("c" + position);
    acc.removeChild(c);
  }
  else{
    var p = document.getElementById("collapse" + parent);
    var c = document.getElementById("q" + parent + child);
    p.removeChild(c);
  }
}

function saveSchema(){
  var cnf = confirm("Are you sure with this edit?");
  if(cnf){
    CloseEditor();
    var title = $('#editor_title').html();
    var id = current_schema.id;
    var domTree = document.getElementById('accordion');
    var outPutJson = '{"content":[';
    for(var i = 0;i<domTree.childNodes.length;i++){
      var NodeTitle = domTree.childNodes[i].childNodes[0].childNodes[0].childNodes[0].innerHTML;
      outPutJson += '{"title":"' + NodeTitle + '","questions":[';
      var current_child = domTree.childNodes[i].childNodes[1];
      for(var j = 0;j<current_child.childNodes.length;j++){
        outPutJson += '"' + current_child.childNodes[j].innerHTML + '"';
        if(j+1 != current_child.childNodes.length){
          outPutJson+= ",";
        }
      }
      outPutJson += ']}';
      if(i+1 != domTree.childNodes.length){
        outPutJson+= ",";
      }
    }
    outPutJson += "]}";
    $.ajax({
       type:'POST',
       url:'/admin/schemas/edit',
       data:{
         id: id,
         title : title,
         body : outPutJson
       },
       success:function(data){
         //console.log(data);
         data = JSON.parse(data.schemas);
         set_original_table_data(data);
          filltable(data);
          openEditor(data[0].id);
       },
       error: function(jqXHR, exception) {
         console.log(jqXHR);
         console.log(exception);
         alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
       }
    });
  }
}

function new_schema(){
  $.ajax({
     type:'POST',
     url:'/admin/schemas/insert',
     data:'i',
     success:function(data){
       //console.log(data);
       data = JSON.parse(data.schemas);
       set_original_table_data(data);
        filltable(data);
        openEditor(data[0].id);
     },
     error: function() {
       alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
     }
  });
}

function delete_schema(id){
  var current_schema;
  for(var i = 0;i<original_table_data.length;i++){
    if(original_table_data[i].id == id){
      current_schema = original_table_data[i];
      break;
    }
  }
  var conf = confirm("Do you really want to permanently delete " + current_schema.title + "? This cannot be undone!");
  if(conf == true){
    $.ajax({
       type:'POST',
       url:'/admin/schemas/delete',
       data:{
         id: id
       },
       success:function(data){
         //console.log(data);
         data = JSON.parse(data.schemas);
         set_original_table_data(data);
          filltable(data);
          openEditor(data[0].id);
       },
       error: function() {
         alert("An Error occured! Please make sure your input is valid, no duplicate entry or invalid data format!");
       }
    });
  }
}

function filltable(data){
  var i;
  var rows='';
  for(i = 0;i<data.length;i++){
    var firstRowStyle = i==0?'class="row_selected"':"";
    rows += '<tr ' + firstRowStyle + ' id="row_num_' + data[i].id + '" onclick="openEditor(' + original_table_data[i].id + ');"' + ' oncontextmenu="return showcontextmenu(' + original_table_data[i].id + ');">';
    rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
    rows += '<td id="title_row_' + data[i].id + '">' + data[i].title + '</td>';
    rows += '</tr>';
  }
  $('#table').DataTable().destroy();
  $("#table_body").html(rows);
  $('#table').DataTable().draw();

}

</script>
<script>
var contextmenu = document.getElementById('contextmenu');
var contextMenuEditor = document.getElementById('contextMenuEditor');
window.onclick = hidecontextmenu;

function showcontextmenu(id){
  $('#delete_link').attr('onclick','delete_schema(' + id + ');');
  contextmenu.style.display = "block";
  contextmenu.style.left = event.pageX + 'px';
  contextmenu.style.top = event.pageY + 'px';
  return false;
  }

  function showcontextmenuEditor(parent,child){
    if($("#saveOrCancleArea").css("display") == "none"){
      return true;
    }
    else{
      if(parent == -1){
        $('#add_question_link').attr('onclick','addQuestion(' + child + ');');
        $('#add_question_link').css('display','block');
      }
      else{
        $('#add_question_link').css('display','none');
      }

      $('#delete_node_link').attr('onclick','deleteNode(' + parent + "," + child + ');');
      contextMenuEditor.style.display = "block";
      contextMenuEditor.style.left = event.pageX + 'px';
      contextMenuEditor.style.top = event.pageY + 'px';
      return false;
    }
  }

  function hidecontextmenu(){
    contextmenu.style.display = "none";
    contextMenuEditor.style.display = "none";
  }

</script>
</body>
</html>
