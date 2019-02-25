<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{$class_name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('teachers.includes.jsandcss')

  </head>
  <body>
    @include('teachers.includes.navbar')

    <div class="container clearfix" style="padding-bottom:100px">
      <div class="page-header">
        <h1>{{$class_name}}</h1>
      </div>
      <div class="row" id="body">
        <div class="col-md-12 content-left">
          <div class="panel-group col-md-12" id="class_a">

            <div class="panel panel-primary">
              <div class="panel-heading">
                <a data-toggle="collapse" href="#detail1" class="panel-title" data-parent="#class_a">
                  Danh sách lớp {{$class_name}}
                </a>
              </div>
              <div class="panel-collapse collapse in" id="detail1">
                <div class="panel-body">
                  <table class="table table-striped table-hover" id = "table1">
                    <thead>
                    <tr>
                      <th class="col-md-2">STT</th>
                      <th class="col-md-2">MSV</th>
                      <th class="col-md-4">Họ và Tên</th>
                      <th class="col-md-4">Email</th>
                    </tr>
                  </thead>
                  <tbody id="student_list">

                    <tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="panel panel-primary">
              <div class="panel-heading">
                <a data-toggle="collapse" href="#detail2" class="panel-title" data-parent="#class_a">
                  Kết quả đánh giá lớp {{$class_name}}
                </a>
              </div>
              <div class="panel-collapse collapse" id="detail2">
                <div class="panel-body">
                  <h4 id="nor">Số lượng sinh viên đã tham gia đánh giá: 0</h4>
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
      </div>
    </div>
    @include('teachers.includes.footer')


    <script>
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
           url:'/teacher/class_data',
           data:'z',
           success:function(data){
             //console.log(data);
             var rawstudentslist = JSON.parse(data.students);
             var rawResult = JSON.parse(data.rawResult);
             var schema = JSON.parse(data.schema);

             console.log(rawstudentslist);
             console.log(rawResult);
             console.log(schema);
            /*
            định dạng json lưu kết quả kháo sát của học sinh: VD:
                  {
                  "r":["1","2","3","4","5","4","3","2","1","2"]
                  }
            Mỗi phần tử trong "r" là value của câu hỏi tương ứng q[position]
            vd : q0 có value là 1
                 q1 có value là 2
            Định dạng survey:
            {
              	"content": [{
              		"title": "something0",
              		"questions": ["q0", "q1"]
              	}, {
              		"title": "something1",
              		"questions": ["q2", "q3", "q4", "q5", "q6"]
              	}, {
              		"title": "something2",
              		"questions": ["q7", "q8", "q9"]
              	}]
              }
            */
            set_original_table_data(rawstudentslist);
            fillStudentTable(rawstudentslist);

            var i;
            var rows='';
            var array = getQuestion(schema);
            for(i = 0;i<array.length;i++){
              for(var i = 0;i<array.length;i++){
                rows += '<tr id="row_num_' + (i+1) + '" oncontextmenu="return showcontextmenu(' + (i+1) + ');"">';
                rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
                rows += '<td id="question_row_' + (i+1) + '">' + array[i] + '</td>';
                rows += '<td id="dtb_row_' + (i+1) + '">' + avgPoint(rawResult, i).toFixed(2) + '</td>';
                rows += '<td id="ps_row_' + (i+1) + '">' + phuongSai(rawResult, i).toFixed(2) + '</td>';
                rows += '<td id="dtb_row_' + (i+1) + '">' + avgPoint(rawResult, i).toFixed(2) + '</td>';
                rows += '<td id="ps_row_' + (i+1) + '">' + phuongSai(rawResult, i).toFixed(2) + '</td>';
                rows += '<td id="dtb_row_' + (i+1) + '">' + avgPoint(rawResult, i).toFixed(2) + '</td>';
                rows += '<td id="ps_row_' + (i+1) + '">' + phuongSai(rawResult, i).toFixed(2) + '</td>';
                rows += '</tr>';
              }
            }
          $("#result_list").html(rows);
          $('#nor').html("Số lượng sinh viên đã tham gia đánh giá: " + rawResult.length)
          }
        });
      });

      function fillStudentTable(data){
        var i;
        var rows='';
        for(i = 0;i<data.length;i++){
          for(var i = 0;i<data.length;i++){
            rows += '<tr id="row_num_' + data[i].id + '" oncontextmenu="return showcontextmenu(' + original_table_data[i].id + ');"">';
            rows += '<td id="stt_row_' + (i+1) + '">' + (i+1) + '</td>';
            rows += '<td id="mssv_row_' + data[i].id + '">' + data[i].student.mssv + '</td>';
            rows += '<td id="name_row_' + data[i].id + '">' + data[i].student.name + '</td>';
            rows += '<td id="class_row_' + data[i].id + '">' + data[i].student.email + '</td>';
            rows += '</tr>';
          }
        }
      $('#table1').DataTable().destroy();
      $("#student_list").html(rows);
      $('#table1').DataTable().draw();

      }

      function fillResultTable(data){

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

      function phuongSai(data, id) {
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
