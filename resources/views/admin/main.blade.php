<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="admin/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="admin/plugins/summernote/summernote-bs4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="admin/plugins/style.css">
  <link rel="stylesheet" href="admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- bootstrap tag input -->
  <link rel="stylesheet" href="admin/plugins/bootstrap-tag-input/all.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="image/base/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">Xem Trang Chủ</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a target="_blank" href="/laravel-filemanager" class="nav-link">Quản lý file</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">Bảo trì</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://www.teamviewer.com/vi/" class="nav-link">Tải Teamviewer</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Google Analytics</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Google Search Console</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="image/base/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Fire Sport Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center">
        <div style="width: 45px; height: 45px; overflow:hidden; border-radius: 6px">
          <img class="w-100 h-100" style="object-fit: cover" src="image/users/user1.png" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Danh Đạt</a>
          <p class="m-0 p-0 text-light">Adminitrator <span class="online-btn ml-1"></span></p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Chức năng chính</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/slider" class="nav-link @if(isset($tab) AND $tab == "slider") active-menu @endif">
              <i class="nav-icon fab fa-slideshare"></i>
              <p>
                Slider
                <span class="right badge badge-info">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/product-category" class="nav-link @if(isset($tab) AND $tab == "productCategory") active-menu @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Loại sản phẩm
                <span class="right badge badge-info">10</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/product" class="nav-link @if(isset($tab) AND $tab == "product") active-menu @endif">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/blog" class="nav-link @if(isset($tab) AND $tab == "blog") active-menu @endif">
              <i class="nav-icon fas fa-solid fa-scroll"></i>
              <p>
                Bài viết
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/template" class="nav-link @if(isset($tab) AND $tab == "template") active-menu @endif">
              <i class="nav-icon fas fa-desktop"></i>
              <p>
                Giao diện
              </p>
            </a>
          </li>
          <li class="nav-header">Tài khoản</li>
          <li class="nav-item">
            <a href="/product" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Đổi mật khẩu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/user" class="nav-link @if(isset($tab) AND $tab == "user_manager") active-menu @endif">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Quản lý tài khoản
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/product" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
              <p>
                Đăng xuất
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2025.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Laravel Framework</b> 8.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="admin/plugins/moment/moment.min.js"></script>
<script src="admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- bootstrap tag inpt -->
<script src="admin/plugins/bootstrap-tag-input/all.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="admin/dist/js/pages/dashboard.js"></script>
<script src="admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="admin/plugins/dropzone/min/dropzone.min.js"></script>
<script src="admin/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="admin/plugins/ckeditor/ckeditor.js"></script>
<script>
    const _token = '{{csrf_token()}}';
    const baseUrl = '{{config('app.url')}}';
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    //Preview image
    $('.input-image').on('change', function(e){
      $('.preview-image').css({'opacity': '0'}).attr('src', "");
      let src = URL.createObjectURL(event.target.files[0]);
      $('.preview-image').css({'opacity': '1'}).attr('src', src);
    });

    //Preview image product
    $('.input-image-1').on('change', function(e){
      $('.preview-image-1').css({'opacity': '0'}).attr('src', "");
      let src = URL.createObjectURL(event.target.files[0]);
      $('.preview-image-1').css({'opacity': '1'}).attr('src', src);
    });
    $('.input-image-2').on('change', function(e){
      $('.preview-image-2').css({'opacity': '0'}).attr('src', "");
      let src = URL.createObjectURL(event.target.files[0]);
      $('.preview-image-2').css({'opacity': '1'}).attr('src', src);
    });

    //Ck editor
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    CKEDITOR.replace('ckeditor_1', options);
    CKEDITOR.replace('ckeditor_2', options);

</script>
<script src="admin/plugins/ajax.js"></script>
<script src="admin/plugins/style.js"></script>
</body>
</html>
