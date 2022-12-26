<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cell | Phone</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome ini-->
  <link rel="stylesheet" href="{{ asset ('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons ini-->
  <link rel="stylesheet" href="{{ asset ('assets/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- Theme style ini-->
  <link rel="stylesheet" href="{{ asset ('assets/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars ini -->
  <link rel="stylesheet" href="{{ asset ('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  @yield('css')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset ('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
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
      </li>

     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{ totalKeterlambatan() }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ totalKeterlambatan() }} Person Buy Phone</span>
    
          <div class="dropdown-divider"></div>
          @foreach(keterlambatan() as $data)
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i>{{ $data->members->name }}
            <span class="float-right text-muted text-sm">Late {{ $data->selisih }} Days</span>
          </a>
          @endforeach

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- Navbar Fullscreen -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- Navbar control sidebar -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <!-- Navbar Logout -->
     
       <li class="nav-item">
         <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
         </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d- none">
               @csrf
        </form>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset ('assets/dist/img/download.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CellPhone</span>
    </a>
    
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset ('assets/dist/img/10602252_202103061019490801.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth ()-> user ()-> name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('home')}}" class="nav-link {{Request()-> is('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('phones')}}" class="nav-link {{ Request()-> is('phones') ? 'active' : ''}}">
              <i class="nav-icon fas fa-mobile"></i>
              <p>
                Phone
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('tablets')}}" class="nav-link {{ Request()-> is('tablets') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tablet"></i>
              <p>
                Tablet 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('laptops')}}" class="nav-link {{ Request()-> is('laptops') ? 'active' : ''}}">
              <i class="nav-icon fas fa-laptop"></i>
              <p>
                Laptop 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('watches')}}" class="nav-link {{ Request()-> is('watches') ? 'active' : ''}}">
            <i class="nav-icon fa fa-clock"></i>
              <p>
                All Brand
              </p>
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a href="{{ url('members')}}" class="nav-link {{ Request()-> is('members') ? 'active' : ''}}">
            <i class="nav-icon fas fa-users mr-2"></i>
              <p>
                 Members 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('transactions')}}" class="nav-link {{ Request()-> is('transactions') ? 'active' : ''}}">
            <i class="nav-icon fas fa-chart-line"></i>
              <p>
                 Transactions 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('Graphics')}}" class="nav-link {{ Request()-> is('Graphics') ? 'active' : ''}}">
            <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                 Graphics
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('header')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
   @yield ('content')
 
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset ('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset ('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset ('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('assets/dist/js/adminlte.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@yield('js')
</body>
</html>