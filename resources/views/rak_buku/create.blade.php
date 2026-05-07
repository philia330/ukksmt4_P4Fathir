@extends('layouts.app')

@section('content')
<section class="section">

  <div class="section-header">
    <h1>Tambah Rak Buku</h1>
  </div>

  <div class="section-body">

    <div class="card">

      {{-- HEADER --}}
      <div class="card-header">
        <h4>Form Tambah Rak Buku</h4>
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
        <form method="POST"
              action="{{ route('rak_buku.store') }}">

          @csrf

          {{-- LOKASI --}}
          <div class="form-group">

            <label>Lokasi Rak</label>

            <input type="text"
                   name="lokasi"
                   class="form-control"
                   value="{{ old('lokasi') }}"
                   placeholder="Masukkan lokasi rak"
                   required>

          </div>

          {{-- BUTTON --}}
          <button class="btn btn-primary">
            Tambah
          </button>

          <a href="{{ route('rak_buku.index') }}"
             class="btn btn-secondary">

            Kembali

          </a>

        </form>

      </div>
    </div>

  </div>
</section>
@endsection