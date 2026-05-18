<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Stisla</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
<div id="app">
<section class="section">
<div class="container mt-5">
<div class="row">
<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

  <div class="login-brand">
    <img src="{{ asset('assets/img/stisla-fill.svg') }}" width="100">
  </div>

  <div class="card card-primary">
    <div class="card-header"><h4>Login</h4></div>

    <div class="card-body">

      {{-- ERROR MESSAGE --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          {{ $errors->first() }}
        </div>
      @endif

      {{-- FORM LOGIN LARAVEL --}}
      <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- EMAIL --}}
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
        </div>

        {{-- PASSWORD --}}
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        {{-- BUTTON --}}
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-lg btn-block">
            Login
          </button>
        </div>

      </form>

    </div>
  </div>

  <div class="simple-footer">
    Copyright &copy; Stisla
  </div>

</div>
</div>
</div>
</section>
</div>

<!-- JS -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
</body>
</html>