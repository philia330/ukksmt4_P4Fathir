@extends('layouts.app')

@section('content')
<section class="section">

  <div class="section-header">
    <h1>Tambah Genre</h1>
  </div>

  <div class="section-body">

    <div class="card">

      {{-- HEADER --}}
      <div class="card-header">
        <h4>Form Tambah Genre</h4>
      </div>

      {{-- BODY --}}
      <div class="card-body">

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('genre.store') }}">
          @csrf

          <div class="form-group">
            <label>Nama Genre</label>

            <input type="text"
                   name="nama"
                   class="form-control"
                   value="{{ old('nama') }}"
                   placeholder="Masukkan nama genre"
                   required>
          </div>

          {{-- BUTTON --}}
          <div class="d-flex">

            <button type="submit" class="btn btn-primary mr-2">
              Tambah
            </button>

            <a href="{{ route('genre.index') }}"
               class="btn btn-secondary">

              Kembali

            </a>

          </div>

        </form>

      </div>
    </div>

  </div>
</section>
@endsection