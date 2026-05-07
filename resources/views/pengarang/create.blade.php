@extends('layouts.app')

@section('content')
<section class="section">

  <div class="section-header">
    <h1>Tambah Pengarang</h1>
  </div>

  <div class="section-body">

    <div class="card">

      {{-- HEADER --}}
      <div class="card-header">
        <h4>Form Tambah Pengarang</h4>
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
              action="{{ route('pengarang.store') }}">

          @csrf

          <div class="row">

            {{-- NAMA --}}
            <div class="form-group col-6">

              <label>Nama Pengarang</label>

              <input type="text"
                     name="nama"
                     class="form-control"
                     value="{{ old('nama') }}"
                     required>

            </div>

            {{-- NO TELEPON --}}
            <div class="form-group col-6">

              <label>No Telepon</label>

              <input type="text"
                     name="no_tlp"
                     class="form-control"
                     value="{{ old('no_tlp') }}"
                     required>

            </div>

          </div>

          {{-- ALAMAT --}}
          <div class="form-group">

            <label>Alamat</label>

            <textarea name="alamat"
                      class="form-control"
                      required>{{ old('alamat') }}</textarea>

          </div>

          <div class="row">

            {{-- JENIS KELAMIN --}}
            <div class="form-group col-6">

              <label>Jenis Kelamin</label>

              <select name="jkl" class="form-control">

                <option value="L">Laki-laki</option>

                <option value="P">Perempuan</option>

              </select>

            </div>

          </div>

          {{-- BUTTON --}}
          <button class="btn btn-primary">
            Tambah
          </button>

          <a href="{{ route('pengarang.index') }}"
             class="btn btn-secondary">

            Kembali

          </a>

        </form>

      </div>
    </div>

  </div>
</section>
@endsection