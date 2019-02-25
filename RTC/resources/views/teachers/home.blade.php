<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('teachers.includes.jsandcss')
</head>
  <body>
    @include('teachers.includes.navbar')

    <div class="container clearfix" style="padding-bottom:100px">
      <div class="page-header">
        <h1>Tất cả khóa học</h1>
      </div>
      <div class="row" id="body">
        <div class="col-md-12 content-left">
          <div id="content" class="row courses" style="margin-top:20px;">
          </div>
        </div>
      </div>
    </div>
    @include('teachers.includes.footer')
  </body>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
      $.ajax({
         type:'POST',
         url:'/teacher/all_courses',
         data:'z',
         success:function(data){
           //console.log(data);
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
                     '<a href="/teacher/' + classesdata[i].id + '" class="panel-title">' + classesdata[i].class_name + '</a>' +
                     '</div><div class="panel-body"><a href="/teacher/' + classesdata[i].id + '"><img class="img-responsive" src="/images/minhoa.png" alt="Minh hoa">' +
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

    function changePassword() {
        event.preventDefault();
        var old_pwd = $("#old_pwd").val();
        var new_pwd = $("#new_pwd").val();
        var confirm = $("#new_pwd2").val();

        if (old_pwd != "" && new_pwd != "" && confirm != "" && new_pwd == confirm) {
            if(window.confirm("Do you really want change password?") === true){
              $.ajax({
                 type:'POST',
                 url:'/teacher/changepassword',
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
  </script>
</html>
