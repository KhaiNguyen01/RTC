<nav class="navbar navbar-default" id="header">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/teacher">
        <img class="img-circle"src="/images/logo.jpg" alt="logo"/>
      </a>
      <span style="line-height:50px; color:#fafafa;padding-right:10px">RTC Giảng viên</span>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      @if (session('teacher_id'))
      <ul class="nav navbar-nav">
        <li class="{{Request::is('teacher')?'active':''}}"><a href="/teacher"><i class="glyphicon glyphicon-th-list"></i>All Courses</a></li>
      </ul>
      @endif
      @if (session('teacher_id'))
      <div class="dropdown navbar-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="/images/f1.png" class="profile-image img-circle"> {{session('teacher_name')}}
        <span class="caret" style="color:#fafafa;"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#" data-toggle="modal" data-target="#change-password">Change password</a></li>
          <li><a href="#">Option</a></li>
          <li><a href="{{URL::action('teacher_routing_controller@logout')}}">Log out</a></li>
        </ul>
      </div>
      @else
      <a href="{{URL::action('teacher_routing_controller@teacherview')}}" class="dropdown navbar-right" style="line-height:50px;color:white"><span class="glyphicon glyphicon-log-in"> </span> Login</a>
      @endif
      <form class="navbar-form navbar-right" action="#">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>
<div id="change-password" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content" id = "modal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Change Your Password</h4>
            </div>
            <div class="modal-body">
              <form onsubmit="changePassword();">
                <input class="form-control" type="hidden" name="id" id="studentid" required>
                <div class="form-group">
                  <label for="old_pwd">Old Password:</label>
                  <input type="password" id="old_pwd" name="old_pwd" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="new_pwd">New Password:</label>
                  <input type="password" id="new_pwd" name="new_pwd" class="form-control" required pattern=".{6,}" title="must contain 6 or more characters">
                </div>
                <div class="form-group">
                  <label for="new_pwd2">Confirm Password:</label>
                  <input type="password" id="new_pwd2" name="new_pwd2" class="form-control" required pattern=".{6,}" title="must contain 6 or more characters" >
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
          </div>

        </div>
      </div>
