<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>RTC - Login</title>
    @include('students.includes.jsandcss')
  </head>

<body>
  @include('students.includes.navbar')

  <div class="container">
            <h2 class="col-md-offset-5 col-xs-offset-5">Sign In</h2>
            <form method="post" action="{{URL::action('student_routing_controller@login')}}">
              {{ csrf_field() }}
              <div class="form-group ">
                <label for="username">Tên tài khoản</label>
                <input type="username" name="username" class="form-control" required id="username" placeholder="Nhập tên tài khoản">
              </div>
              <div class="form-group ">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required id="password" placeholder="Mật khẩu">
              </div>
              @if(session('error'))
              <div class="row">
                <div class="alert alert-danger alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  incorrect username or password
                </div>
              </div>
              @endif
              <button type="submit" class="btn btn-primary col-xs-offset-5">Đăng nhập</button>
            </form>
   </div>
@include('students.includes.footer')
</body>
<html>
