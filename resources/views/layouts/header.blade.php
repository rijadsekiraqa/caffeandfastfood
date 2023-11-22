<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>assa</title>


    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/custom.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">


    </style>
    <style>
        .user-img{
            position: absolute;
            height: 27px;
            width: 27px;
            object-fit: cover;
            left: -7%;
            top: -12%;
        }
        .btn-rounded{
            border-radius: 50px;
        }
    </style>
    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('dist/js/script.js')}}"></script>

</head>

<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs text-sm" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-dark shadow text-sm bg-gradient-navy">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="" class="nav-link">Coffee Shop Cashiering System - Admin</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li> -->
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
            <div class="btn-group nav-link">
                <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span><img src="uploads/avatars/1.png" class="img-circle elevation-2 user-img" alt="User Image"></span>
                    <span class="ml-3">{{ $user->firstname }} {{ $user->lastname }}</span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="{{ route('adminprofile') }}"><span class="fa fa-user"></span> My Account</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" onclick="logout()"><span class="fas fa-sign-out-alt"></span> Logout</a>
                </div>
            </div>
        </li>
        <li class="nav-item">

        </li>
        <!--  <li class="nav-item">
           <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
           <i class="fas fa-th-large"></i>
           </a>
         </li> -->
    </ul>
</nav>

    <script>
        function logout() {
            // You can perform additional actions here before logging out if needed
            $.post('{{ route('logout') }}', {_token: '{{ csrf_token() }}'}, function () {
                // This function is executed after the logout is successful
                // You can redirect or perform other actions here if needed
                window.location.href = '{{ route('login') }}';
            });
        }
    </script>
<!-- /.navbar -->
@yield('content')
