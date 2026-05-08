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
          <a href="{{ route('buku.create') }}"
             class="btn btn-primary">

            + Tambah Buku

          </a>

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
                <th>Action</th>

              </tr>
            </thead>

            <tbody>

              @forelse($buku as $item)
              <tr>

                <td>
                  {{ ($buku->currentPage() - 1) * $buku->perPage() + $loop->iteration }}
                </td>

                {{-- FOTO --}}
                <td>

                  @if($item->foto)

                    <img src="{{ asset('uploads/buku/' . $item->foto) }}"
                         width="70">

                  @else

                    Tidak ada foto

                  @endif

                </td>

                <td>{{ $item->judul }}</td>

                <td>{{ $item->genre->nama }}</td>

                <td>{{ $item->pengarang->nama }}</td>

                <td>{{ $item->penerbit->nama }}</td>

                <td>{{ $item->rak->lokasi }}</td>

                <td>{{ $item->tahun }}</td>

                <td>{{ $item->stok }}</td>

                <td>

                  <a href="{{ route('buku.edit', $item->id) }}"
                     class="btn btn-warning btn-sm">

                    <i class="fas fa-edit"></i>

                  </a>

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

              </tr>

              @empty
              <tr>

                <td colspan="10"
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