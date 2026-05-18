@extends('layouts.app')

@section('content')
<section class="section">

  <div class="section-header">
    <h1>Edit Buku</h1>
  </div>

  <div class="section-body">

    <div class="card">

      {{-- HEADER --}}
      <div class="card-header">
        <h4>Form Edit Buku</h4>
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
              action="{{ route('buku.update', $buku->id) }}"
              enctype="multipart/form-data">

          @csrf
          @method('PUT')

          <div class="row">

            {{-- JUDUL --}}
            <div class="form-group col-6">

              <label>Judul Buku</label>

              <input type="text"
                     name="judul"
                     class="form-control"
                     value="{{ old('judul', $buku->judul) }}"
                     required>

            </div>

            {{-- TAHUN --}}
            <div class="form-group col-6">

              <label>Tahun</label>

              <input type="number"
                     name="tahun"
                     class="form-control"
                     value="{{ old('tahun', $buku->tahun) }}"
                     required>

            </div>

          </div>

          <div class="row">

            {{-- KELAS --}}
            <div class="form-group col-6">

              <label>Genre</label>

              <select name="id_genre"
                      class="form-control"
                      required>

                @foreach($genre as $item)
                  <option value="{{ $item->id }}"
                    {{ $buku->id_genre == $item->id ? 'selected' : '' }}>

                    {{ $item->nama }}

                  </option>
                @endforeach

              </select>

            </div>

            {{-- PENGARANG --}}
            <div class="form-group col-6">

              <label>Pengarang</label>

              <select name="id_pengarang"
                      class="form-control"
                      required>

                @foreach($pengarang as $item)
                  <option value="{{ $item->id }}"
                    {{ $buku->id_pengarang == $item->id ? 'selected' : '' }}>

                    {{ $item->nama }}

                  </option>
                @endforeach

              </select>

            </div>

          </div>

          <div class="row">

            {{-- PENERBIT --}}
            <div class="form-group col-6">

              <label>Penerbit</label>

              <select name="id_penerbit"
                      class="form-control"
                      required>

                @foreach($penerbit as $item)
                  <option value="{{ $item->id }}"
                    {{ $buku->id_penerbit == $item->id ? 'selected' : '' }}>

                    {{ $item->nama }}

                  </option>
                @endforeach

              </select>

            </div>

            {{-- RAK --}}
            <div class="form-group col-6">

              <label>Rak Buku</label>

              <select name="id_rak"
                      class="form-control"
                      required>

                @foreach($rak_buku as $item)
                  <option value="{{ $item->id }}"
                    {{ $buku->id_rak == $item->id ? 'selected' : '' }}>

                    {{ $item->lokasi }}

                  </option>
                @endforeach

              </select>

            </div>

          </div>

          <div class="row">

            {{-- STOK --}}
            <div class="form-group col-6">

              <label>Stok</label>

              <input type="number"
                     name="stok"
                     class="form-control"
                     value="{{ old('stok', $buku->stok) }}"
                     required>

            </div>

            {{-- FOTO --}}
            <div class="form-group col-6">

              <label>Foto Buku</label>

              <input type="file"
                     name="foto"
                     class="form-control">

            </div>

          </div>

          {{-- FOTO LAMA --}}
          @if($buku->foto)

            <div class="form-group">

              <label>Foto Saat Ini</label>

              <br>

              <img src="{{ asset('uploads/buku/' . $buku->foto) }}"
                   width="120">

            </div>

          @endif

          {{-- BUTTON --}}
          <button class="btn btn-primary">
            Update
          </button>

          <a href="{{ route('buku.index') }}"
             class="btn btn-secondary">

            Kembali

          </a>

        </form>

      </div>

    </div>

  </div>
</section>
@endsection