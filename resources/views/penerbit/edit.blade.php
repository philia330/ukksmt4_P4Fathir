@extends('layouts.app')

@section('content')
<section class="section">

  <div class="section-header">
    <h1>Edit Penerbit</h1>
  </div>

  <div class="section-body">

    <div class="card">

      <div class="card-header">
        <h4>Form Edit Penerbit</h4>
      </div>

      <div class="card-body">

        {{-- ERROR --}}
        @if ($errors->any())
          <div class="alert alert-danger">

            <ul class="mb-0">

              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach

            </ul>

          </div>
        @endif

        <form method="POST"
              action="{{ route('penerbit.update', $penerbit->id) }}">

          @csrf
          @method('PUT')

          {{-- NAMA --}}
          <div class="form-group">

            <label>Nama Penerbit</label>

            <input type="text"
                   name="nama"
                   class="form-control"
                   value="{{ old('nama', $penerbit->nama) }}"
                   required>

          </div>

          {{-- ALAMAT --}}
          <div class="form-group">

            <label>Alamat</label>

            <textarea name="alamat"
                      class="form-control"
                      required>{{ old('alamat', $penerbit->alamat) }}</textarea>

          </div>

          <button class="btn btn-primary">
            Update
          </button>

          <a href="{{ route('penerbit.index') }}"
             class="btn btn-secondary">

            Kembali

          </a>

        </form>

      </div>

    </div>

  </div>
</section>
@endsection