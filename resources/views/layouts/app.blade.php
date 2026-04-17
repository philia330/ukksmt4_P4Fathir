<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>@yield('title') &mdash; Stisla</title>

  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

  @stack('css_libraries')
  <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-94034622-3');
  </script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name ?? 'Ujang Maman' }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="#" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
             
            </div>
          </li>
        </ul>
      </nav>

      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ url('/') }}">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>

            <li class="menu-header">Main Menu</li>
            <li class="dropdown {{ Request::is('components*') ? 'active' : '' }}">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Components</span></a>
              <ul class="dropdown-menu"> 
                <li><a class="nav-link" href="#">Table</a></li>     
              </ul>
            </li>

            <li class="menu-header">Pages</li>
              <li class="dropdown {{ Request::is('login-page') || Request::is('register-page') ? 'active' : '' }}">
                  <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
                  <ul class="dropdown-menu">
                      <li class="{{ Request::is('login-page') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('login') }}">Login</a>
                      </li>
                      <li class="{{ Request::is('register-page') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('register') }}">Register</a>
                      </li>
                  </ul>
              </li>

          </ul>
        </aside>
      </div>

      <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>@yield('header')</h1>
            </div>

            <div class="section-body">
                @yield('content')
            </div>
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
      </footer>
    </div>
  </div>

  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  
  @stack('js_libraries')
  <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>

  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  @stack('scripts')
</body>
</html>