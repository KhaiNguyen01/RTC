<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{$class_name}}</title>
    @include('students.includes.jsandcss')
  </head>
  <body>
    @include('students.includes.navbar')

    <div class="container" style="padding-bottom:100px">
      <div class="page-header">
        <h1>{{$class_name}}</h1>
        <h4>Giảng viên: {{$class_teacher}}</h4>
      </div>
      <h4 style="padding:0 32px 32px 32px">
        @if($result == null)
        Hướng dẫn: Đánh giá các tiêu chí có sẵn theo thang điểm 1 - 5 bằng cách tích vào ô tương ứng
        @else
        Cảm ơn bạn đã làm khảo sát. Kết quả khảo sát của bạn được hiện ở đây
        @endif
      </h4>
      <div class="row">
        <div class="col-md-2 col-xs-12">
            <ul class="nav nav-pills nav-stacked pull-right">
              <?php
              $i = 0;
                foreach ($schema_content as $q) { ?>
                  <li><a href="#section<?php echo $i ?>"><?php echo $q->title ?></a></li>
              <?php
              $i++;
                }
              ?>

            </ul>
        </div>
        <div class="col-md-10" style="border-Left:1px dashed #999;">
          @if($result==null)<form method="post" action="{{URL::action('student_data_controller@rate')}}">
            {{csrf_field()}}
            @endif
            <?php
              $k = 0;
              for($i = 0;$i<sizeof($schema_content);$i++){
            ?>
              <div id="section<?php echo $i ?>" class="panel panel-primary">
                <div class="panel-heading">
                  <span>
                    <?php echo $schema_content[$i]->title; ?>
                    <ul class="col-sm-6 list-inline pull-right">
                      <li class="col-sm-2"></li>
                      <li class="col-sm-2">1</li>
                      <li class="col-sm-2">2</li>
                      <li class="col-sm-2">3</li>
                      <li class="col-sm-2">4</li>
                      <li class="col-sm-2">5</li>
                    </ul>
                  </span>
                </div>
                <?php
                  $questions = $schema_content[$i]->questions;
                  for($j = 0 ; $j<sizeof($questions);$j++){
                ?>
                <div class="panel-body">
                    <div class="col-sm-5 pull-left"><?php echo $questions[$j] ?></div>
                    <div class="form-inline col-sm-6 pull-right" style="margin-right:10px">
                      <div class="col-sm-2">
                      </div>
                      <div class="radio col-sm-2">
                        <input type="radio" name="q_<?php echo $i; ?>_<?php echo $j; ?>" value="1" <?php if($result!=null && $result[$k] == 1) echo 'checked'; ?><?php if($result!=null) echo ' disabled'; ?> >
                      </div>
                      <div class="radio col-sm-2">
                        <input type="radio" name="q_<?php echo $i; ?>_<?php echo $j; ?>" value="2" <?php if($result!=null && $result[$k] == 2) echo 'checked'; ?><?php if($result!=null) echo ' disabled'; ?> >
                      </div>
                      <div class="radio col-sm-2">
                        <input type="radio" name="q_<?php echo $i; ?>_<?php echo $j; ?>" value="3" <?php if(($result!=null && $result[$k] == 3)||$result==null){echo 'checked';} ?><?php if($result!=null) echo ' disabled'; ?> >
                      </div>
                      <div class="radio col-sm-2">
                        <input type="radio" name="q_<?php echo $i; ?>_<?php echo $j; ?>" value="4" <?php if($result!=null && $result[$k] == 4) echo 'checked'; ?><?php if($result!=null) echo ' disabled'; ?> >
                      </div>
                      <div class="radio col-sm-2">
                        <input type="radio" name="q_<?php echo $i; ?>_<?php echo $j; ?>" value="5" <?php if($result!=null && $result[$k] == 5) echo 'checked'; ?><?php if($result!=null) echo ' disabled'; ?> >
                      </div>
                    </div>
                </div>
              <?php $k++; } ?>
              </div>
        <?php } ?>
          <div class="col-sm-12">
            @if($result==null)<input class="btn btn-success pull-right" type="submit" value="submit">@endif
          </div>
        @if($result==null)</form>@endif
        </div>

      </div>
    </div>
    @include('students.includes.footer')
    </body>
</html>
