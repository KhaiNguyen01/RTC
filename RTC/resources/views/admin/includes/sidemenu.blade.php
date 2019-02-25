<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/images/nyan.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo session('admin_username');?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{Request::is('admin/dashboard')?'active':''}}">
        <a href="/admin/dashboard">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="{{Request::is('admin/students')?'active':''}}">
        <a href="/admin/students">
          <i class="fa fa-users"></i> <span>Quản lý sinh viên</span>
        </a>
      </li>
      <li class="{{Request::is('admin/teachers')?'active':''}}">
        <a href="/admin/teachers">
          <i class="fa fa-user"></i> <span>Quản lý giáo viên</span>
        </a>
      </li>
      <li class="{{Request::is('admin/classes')?'active':''}}">
        <a href="/admin/classes">
          <i class="fa fa-book"></i> <span>Quản lý lớp môn học</span>
        </a>
      </li>
      <li class="{{Request::is('admin/survey_schema')?'active':''}}">
        <a href="/admin/survey_schema">
          <i class="fa fa-clone"></i> <span>Quản lý mẫu khảo sát</span>
        </a>
      </li>
      <li class="{{Request::is('admin/surveys')?'active':''}}">
        <a href="/admin/surveys">
          <i class="fa fa-calendar"></i> <span>Quản lý khảo sát</span>
        </a>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
