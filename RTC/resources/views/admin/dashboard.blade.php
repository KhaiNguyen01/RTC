<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
@include('admin.jsandcss')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@include('admin.includes.header')
@include('admin.includes.sidemenu')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <section class="col-lg-7 connectedSortable">
          <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Teachers</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix" id="teachers_list">
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="/admin/teachers" class="uppercase">View All teachers</a>
                </div>
                <!-- /.box-footer -->
              </div>

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Surveys</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Participating Class</th>
                    <th>Completed Surveys</th>
                  </tr>
                  </thead>
                  <tbody id="surveys_table_body">

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="/admin/surveys" class="btn btn-sm btn-default btn-flat pull-right">View All surveys</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </section>
        <section class="col-lg-5 connectedSortable">
          <!-- PRODUCT LIST
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Todo list</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-info">
                    <a href="" class="product-title">Buy milk and eggs - 12/12/2018 15:00
                      <span class="label label-warning pull-right">25000 VND</span></a>
                  </div>
                </li>
                <li class="item">
                  <div class="product-info">
                    <a href="" class="product-title">Feed the birds - 12/12/2018 15:00
                      <span class="label label-success pull-right">already done</span></a>
                  </div>
                </li>
                <li class="item">
                  <div class="product-info">
                    <a href="" class="product-title">Create Surveys - 12/12/2018 15:00
                      <span class="label label-success pull-right">already done</span></a>
                  </div>
                </li>
              </ul>
            </div>

            <div class="box-footer text-center">
              <a href="/admin/products" class="uppercase">View All Todos</a>
            </div>

          </div>
            box-footer -->
          <div class="box box-info">
                <div class="box-header with-border">
                  <i class="fa fa-envelope"></i>

                  <h3 class="box-title">Quick Email</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <form action="#" method="post">
                    <div class="form-group">
                      <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="subject" placeholder="Subject">
                    </div>
                    <div>
                      <textarea class="textarea" placeholder="Message"
                                style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                  </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                    <i class="fa fa-arrow-circle-right"></i></button>
                </div>
                <!-- /.box-footer -->
              </div>
        </section>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('admin.includes.footer')
</div>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
  $.ajax({
     type:'POST',
     url:'/admin/dashboard_data',
     success:function(data){
       //console.log(data);
       //survey = JSON.parse(data.survey_results);
       var surveys = JSON.parse(data.survey_results);
       var teachers = JSON.parse(data.teachers);
       filldata(surveys, teachers);
     },
     error: function(a, b) {
       console.log(a);
       alert("An Error occured! Please refresh this page");
     }
  });
});

function  filldata(surveys, teachers){
  var teachers_content = "";
  for(var i = 0;i<teachers.length;i++){
    if(i==8){
      break;
    }
    teachers_content += '<li><a class="users-list-name" href="/admin/teachers">' + teachers[i].name + '</a>';
    teachers_content += '<span class="users-list-date">' + teachers[i].email + '</span></li>';
  }
  $('#teachers_list').html(teachers_content);


  var surveys_content = "";

  for(var i = 0;i<surveys.length;i++){
    if(i==8){
      break;
    }
    surveys_content += '<tr>';
    surveys_content += '<td>'+ (i+1) +'</td>';
    surveys_content += '<td>'+ surveys[i].class_name +'</td>';
    surveys_content += '<td>'+ surveys[i].count + ' sinh viên' +'</td>';
    surveys_content += '</tr>';
  }
  $('#surveys_table_body').html(surveys_content);
}
</script>
</body>
</html>
