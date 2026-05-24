@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-12">

    @if(session('success'))

      <div class="alert alert-success alert-dismissible fade show">

        {{ session('success') }}

        <button type="button"
                class="close"
                data-dismiss="alert">

          &times;

        </button>

      </div>

    @endif

    <div class="card">

      {{-- HEADER --}}
      <div class="card-header d-flex justify-content-between align-items-center">

        <h4>Data Buku</h4>

        <div class="d-flex">

          {{-- SEARCH --}}
          <form method="GET"
                action="{{ route('buku.index') }}"
                class="mr-2">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari buku..."
                   value="{{ request('search') }}">

          </form>

          {{-- RESET --}}
          <a href="{{ route('buku.index') }}"
             class="btn btn-secondary mr-2">

            Reset

          </a>

          {{-- TAMBAH --}}
          @if(auth()->user()->role == 'admin')

          <a href="{{ route('buku.create') }}"
             class="btn btn-primary">

            + Tambah Buku

          </a>

          @endif

        </div>

      </div>

      {{-- BODY --}}
      <div class="card-body p-0">

        <div class="table-responsive">

          <table class="table table-striped table-md">

            <thead>

              <tr>

                <th>#</th>
                <th>Foto</th>
                <th>Judul</th>
                <th>Genre</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Rak</th>
                <th>Tahun</th>
                <th>Stok</th>

                {{-- ACTION HANYA ADMIN --}}
                @if(auth()->user()->role == 'admin')

                  <th>Action</th>

                @endif

              </tr>

            </thead>

            <tbody>

              @forelse($buku as $item)

              <tr>

                {{-- NOMOR --}}
                <td>

                  {{ ($buku->currentPage() - 1) * $buku->perPage() + $loop->iteration }}

                </td>

                {{-- FOTO --}}
                <td>

                  @if($item->foto)

                    <img src="{{ asset('uploads/buku/' . $item->foto) }}"
                         width="70"
                         class="rounded">

                  @else

                    Tidak ada foto

                  @endif

                </td>

                {{-- JUDUL --}}
                <td>

                  {{ $item->judul }}

                </td>

                {{-- GENRE --}}
                <td>

                  {{ $item->genre->nama }}

                </td>

                {{-- PENGARANG --}}
                <td>

                  {{ $item->pengarang->nama }}

                </td>

                {{-- PENERBIT --}}
                <td>

                  {{ $item->penerbit->nama }}

                </td>

                {{-- RAK --}}
                <td>

                  {{ $item->rak->lokasi }}

                </td>

                {{-- TAHUN --}}
                <td>

                  {{ $item->tahun }}

                </td>

                {{-- STOK --}}
                <td>

                  @if($item->stok > 0)

                    <span class="badge badge-success">

                      {{ $item->stok }}

                    </span>

                  @else

                    <span class="badge badge-danger">

                      Habis

                    </span>

                  @endif

                </td>

                {{-- ACTION HANYA ADMIN --}}
                @if(auth()->user()->role == 'admin')

                <td>

                  {{-- EDIT --}}
                  <a href="{{ route('buku.edit', $item->id) }}"
                     class="btn btn-warning btn-sm">

                    <i class="fas fa-edit"></i>

                  </a>

                  {{-- DELETE --}}
                  <form action="{{ route('buku.destroy', $item->id) }}"
                        method="POST"
                        style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data?')">

                      <i class="fas fa-trash"></i>

                    </button>

                  </form>

                </td>

                @endif

              </tr>

              @empty

              <tr>

                <td colspan="{{ auth()->user()->role == 'admin' ? '10' : '9' }}"
                    class="text-center">

                  Data buku tidak ditemukan

                </td>

              </tr>

              @endforelse

            </tbody>

          </table>

        </div>

      </div>

      {{-- PAGINATION --}}
      <div class="card-footer text-right">

        {{ $buku->withQueryString()->onEachSide(1)->links() }}

      </div>

    </div>

  </div>
</div>

@endsection