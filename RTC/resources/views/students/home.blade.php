<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('students.includes.jsandcss')
  </head>
  <body>
    @include('students.includes.navbar')

    <div class="container clearfix" style="padding-bottom:100px">
      <div class="page-header">
        <h1>Tất cả khóa học</h1>
      </div>
      <div class="row" id="body">
        <div id="content" class="@if (session('student_id'))col-md-9 @else col-md-12 @endif content-left" @if (session('student_id')) style="border-right:1px dashed #999;" @endif>

        </div>
        @if (session('student_id'))
        <div class="col-md-3 col-xs-12 content-right">

          <div class="content-right1">
            <p class="header-right">
              <h4>Công Việc <i class="glyphicon glyphicon-briefcase"></i></h4>
            </p>
            <ul class="list-unstyled" style="margin:15px 0 0 15px;">
              <li class="todo-item"><h5>Đánh giá môn học các lớp đang tham gia</h5></li>
            </ul>
          </div>
        </div>
        @endif
      </div>
    </div>
@include('students.includes.footer')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function changePassword() {
    event.preventDefault();
    var old_pwd = $("#old_pwd").val();
    var new_pwd = $("#new_pwd").val();
    var confirm = $("#new_pwd2").val();

    if (old_pwd != "" && new_pwd != "" && confirm != "" && new_pwd == confirm) {
        if(window.confirm("Do you really want change password?") === true){
          $.ajax({
             type:'POST',
             url:'/my/changepassword',
             data:{
               old : old_pwd,
               new : new_pwd
             },
             success:function(data){
               $('#change-password').modal('hide');
               $('#old_pwd').val("");
               $('#new_pwd').val("");
               $('#new_pwd2').val("");
               alert(data.text);
             },
             error: function(a,b) {
               console.log(a);
               $('#change-password').modal('hide');
               $('#old_pwd').val("");
               $('#new_pwd').val("");
               $('#new_pwd2').val("");
               alert("An Error occured! Please make sure your input is valid!");
             }
          });
        }
      }
      else{
        alert("Please make sure every fields are entered correctly");
      }
    }

@if(Request::is('/'))
$(document).ready(function(){
  $.ajax({
     type:'POST',
     url:'/students/all_courses',
     data:'z',
     success:function(data){
       console.log(data);
       classesdata = JSON.parse(data.courses);
       var rows='';
       for(var i = 0;i<classesdata.length;i++){
         if(i%3==0 && i > 0){
           rows += '</div>';
         }
         if(i%3==0){
           rows += '<div class="row courses" style="margin-top:20px;">';
         }

         rows += '<div class="col-md-4 col-xs-6"><div class="panel panel-primary"><div class="panel-heading">' +
                 '<a href="#" class="panel-title">' + classesdata[i].class_name + '</a>' +
                 '</div><div class="panel-body"><a href="#"><img class="img-responsive" src="/images/minhoa.png" alt="Minh hoa">' +
                 '</a></div></div></div>';
       }
       $("#content").html(rows);
     },
     error: function(a,b) {
       console.log(a);
       console.log(b);
       alert("An Error occured! Please refresh this page");
     }
  });
});
@endif
@if(Request::is('my'))
$(document).ready(function(){
  $.ajax({
     type:'POST',
     url:'/students/my_courses',
     data:'z',
     success:function(data){
       console.log(data);
       classesdata = JSON.parse(data.courses);

       var rows='';
       for(var i = 0;i<classesdata.length;i++){
         if(i%3==0 && i > 0){
           rows += '</div>';
         }
         if(i%3==0){
           rows += '<div class="row courses" style="margin-top:20px;">';
         }

         rows += '<div class="col-md-4 col-xs-6"><div class="panel panel-primary"><div class="panel-heading">' +
                 '<a href="/my/' + classesdata[i].class_id + '" class="panel-title">' + classesdata[i].class.class_name + '</a>' +
                 '</div><div class="panel-body"><a href="/my/' + classesdata[i].class_id +
                 '"><img class="img img-responsive" src="/images/minhoa.png" alt="Minh hoa" style="width:100%">' +
                 '</a></div></div></div>';
       }
       $("#content").html(rows);
     },
     error: function(a,b) {
       console.log(a);
       console.log(b);
       alert("An Error occured! Please refresh this page");
     }
  });
});
@endif

</script>
  </body>
</html>
