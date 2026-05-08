@extends('layouts.app')

@section('content')
<section class="section">

  <div class="section-header">
    <h1>Edit Genre</h1>
  </div>

  <div class="section-body">

    <div class="card">

      {{-- HEADER --}}
      <div class="card-header">
        <h4>Form Edit Genre</h4>
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
              action="{{ route('genre.update', $genre->id) }}">

          @csrf
          @method('PUT')

          <div class="form-group">

            <label>Nama Genre</label>

            <input type="text"
                   name="nama"
                   class="form-control"
                   value="{{ old('nama', $genre->nama) }}"
                   placeholder="Masukkan nama genre"
                   required>

          </div>

          {{-- BUTTON --}}
          <button class="btn btn-primary">
            Update
          </button>

          <a href="{{ route('genre.index') }}"
             class="btn btn-secondary">

            Kembali

          </a>

        </form>

      </div>
    </div>

  </div>
</section>
@endsection