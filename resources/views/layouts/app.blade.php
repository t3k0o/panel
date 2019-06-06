
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Hercules | Dashboard</title>
  <!-- Favicon -->
  <link href="{{ asset('images/brand/favicon.png')}}" rel="icon" type="image/png">
 
  <link href="{{ asset('css/argon/nucleo/css/nucleo.css')}}" rel="stylesheet">
  <link href="{{ asset('css/argon/all.min.css')}}" rel="stylesheet">
  <link href="{{ asset('css/argon/fontawesome/all.css')}}" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="{{ asset('css/argon/argon.css?v=1.0.0')}}" rel="stylesheet">
  @toastr_css
  <link type="text/css" href="{{ asset('css/datatables.min.css')}}" rel="stylesheet">
  <link type="text/css" href="{{ asset('css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
  <style type="text/css">
    td.details-control {
          background: url('{{asset('images/details_open.png')}}') no-repeat center center;
          cursor: pointer;
    }
    tr.shown td.details-control {
          background: url('{{asset('images/details_close.png')}}') no-repeat center center;
    }

    .label-info{
      background-color: #5cb85c !important;
    }
    .label-danger{
      background-color: #d9534f !important;
    }
    .label {
      display: inline;
      padding: .2em .6em .3em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      color: white;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: .25em;
    }
  </style>
  
</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="{{ route('home') }}">
        <img src="{{ asset('images/brand/blue.png')}}" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{ asset('images/theme/react.jpg')}}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">¡Sé que no estás trabajando puñetas!</h6>
            </div>
            <!-- <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a> -->
            <!-- <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a> -->
            <!-- <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a> -->
            <!-- <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a> -->
            <div class="dropdown-divider"></div>
            <a href="#!" class="dropdown-item" 
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
            {{ __('Logout') }}>
              <i class="ni ni-user-run"></i>
              <span>Cerrar sesión</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{route('home')}}">
                <img src="{{ asset('images/brand/blue.png')}}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          @can('bancomer.personal.index')
            <li class="nav-item">
              <a class="nav-link" href="" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" data-target="#products">
                <i class="text-blue"> <img src="{{asset('images/logo_azul/bbva.png')}}" alt="logo azul" width="25px"></i> Bancomer
              </a>
              <ul class="sub-menu collapse" id="products">
                <li class="offset-1"><a href="{{route('bancomer.personal.index')}}"><i class="ni ni-single-02 text-primary"></i> Personal</a></li>
                  <li class="offset-1"><a href="#"><i class="fa fa-building text-primary"></i> Empresas</a></li>
                  <li class="offset-1"><a href="#"><i class="fas fa-edit"></i> Registro</a></li>
                  <li class="offset-1"><a href="{{route('bancomer.etiqueta.index')}}"><i class="fas fa-tags"></i> Etiquetas</a></li>
                  <li class="offset-1"><a href="{{route('bancomer.ordenes.index')}}"><i class="fab fa-jedi-order"></i> Órdenes</a></li>
                </li>
              </ul>
            </li>
          @endcan

          <li class="nav-item">
            <a class="nav-link" href="./examples/maps.html">
              <i class="ni ni-pin-3 text-orange"></i> Maps
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/profile.html">
              <i class="ni ni-single-02 text-yellow"></i> User profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/tables.html">
              <i class="ni ni-chart-bar-32 text-red"></i> Estadisticas
            </a>
          </li>
          @can('roles.index')
          <li class="nav-item">
            <a class="nav-link" href="{{route('roles.index')}}">
              <i class="fas fa-filter text-info"></i> Roles
            </a>
          </li>
          @endcan
          @can('users.index')
          <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
              <i class="ni ni-circle-08 text-pink"></i> Usuarios
            </a>
          </li>
          @endcan
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Documentation</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
              <i class="ni ni-spaceship"></i> Getting started
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
              <i class="ni ni-palette"></i> Foundation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
              <i class="ni ni-ui-04"></i> Components
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{route('home')}}">Dashboard</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{ asset('images/theme/react.jpg')}}">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"  href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    {{ __('Logout') }}>{{ Auth::user()->nickname }}
                </span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                  
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">¡Sé que no estás trabajando puñetas!</h6>
              </div>
              <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"
                {{ __('Logout') }}>
                <i class="ni ni-user-run"></i>
                <span>Cerrar sesión</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"> 
        </div>
        
    <!-- Page content -->
    <div class="container-fluid mt--9">
        @yield('content')
      
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <!-- <script src="{{ asset('js/jquery.cookie.min.js') }}"></script> -->
  @toastr_js
  @toastr_render
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/argon.js?v=1.0.0') }}"></script>
  <script src="{{ asset('js/datatables.min.js') }}"></script>
  <script src="{{ asset('js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('js/vfs_fonts.js') }}"></script>
  @yield('javascript')
  
  
</body>

</html>
