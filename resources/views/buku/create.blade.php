@extends('layouts.app')

@section('content')
<section class="section">

  <div class="section-header">
    <h1>Tambah Buku</h1>
  </div>

  <div class="section-body">

    <div class="card">

      {{-- HEADER --}}
      <div class="card-header">
        <h4>Form Tambah Buku</h4>
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
              action="{{ route('buku.store') }}"
              enctype="multipart/form-data">

          @csrf

          <div class="row">

            {{-- JUDUL --}}
            <div class="form-group col-6">

              <label>Judul Buku</label>

              <input type="text"
                     name="judul"
                     class="form-control"
                     value="{{ old('judul') }}"
                     required>

            </div>

            {{-- TAHUN --}}
            <div class="form-group col-6">

              <label>Tahun</label>

              <input type="number"
                     name="tahun"
                     class="form-control"
                     value="{{ old('tahun') }}"
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

                <option value="">-- Pilih Genre --</option>

                @foreach($genre as $item)
                  <option value="{{ $item->id }}">

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

                <option value="">-- Pilih Pengarang --</option>

                @foreach($pengarang as $item)
                  <option value="{{ $item->id }}">

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

                <option value="">-- Pilih Penerbit --</option>

                @foreach($penerbit as $item)
                  <option value="{{ $item->id }}">

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

                <option value="">-- Pilih Rak --</option>

                @foreach($rak_buku as $item)
                  <option value="{{ $item->id }}">

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
                     value="{{ old('stok') }}"
                     required>

            </div>

            {{-- FOTO --}}
            <div class="form-group col-6">

              <label>Foto Buku</label>

              <input type="file"
                    name="foto"
                    class="form-control"
                    accept="image/*"
                    onchange="previewImage(event)">

              {{-- PREVIEW --}}
              <div class="mt-3">

                <img id="preview"
                    src=""
                    alt="Preview Foto"
                    class="img-thumbnail shadow"
                    width="200"
                    style="display:none;">

              </div>

            </div>

          </div>

          {{-- BUTTON --}}
          <button class="btn btn-primary">
            Tambah
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

<script>

function previewImage(event)
{
    const image = document.getElementById('preview');

    image.src = URL.createObjectURL(event.target.files[0]);

    image.style.display = 'block';
}

</script>
@endsection