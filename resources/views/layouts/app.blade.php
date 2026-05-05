<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
<div id="app">

  <div class="main-wrapper main-wrapper-1">

    {{-- NAVBAR --}}
    @include('layouts.navbar')

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- MAIN CONTENT --}}
    <div class="main-content">
      <section class="section">
        <div class="section-header">
          <h1>@yield('title', 'Dashboard')</h1>
        </div>

        <div class="section-body">
          @yield('content')
        </div>
      </section>
    </div>

    {{-- FOOTER --}}
    <footer class="main-footer">
      <div class="footer-left">
        Copyright &copy; {{ date('Y') }}
      </div>
    </footer>

  </div>

</div>

<!-- JS -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>