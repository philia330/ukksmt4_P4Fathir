@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">

    {{-- ALERT --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    @endif

    <div class="card">

      {{-- HEADER --}}
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Data Pengarang</h4>

        <div class="d-flex">

          {{-- SEARCH --}}
          <form method="GET" action="{{ route('pengarang.index') }}" class="mr-2">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari pengarang..."
                   value="{{ request('search') }}">

          </form>

          {{-- RESET --}}
          <a href="{{ route('pengarang.index') }}"
             class="btn btn-secondary mr-2">

            Reset

          </a>

          {{-- TAMBAH --}}
          <a href="{{ route('pengarang.create') }}"
             class="btn btn-primary">

            + Tambah Pengarang

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
                <th>Nama</th>
                <th>JKL</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              @forelse($pengarang as $item)
              <tr>

                {{-- NOMOR --}}
                <td>
                  {{ ($pengarang->currentPage() - 1) * $pengarang->perPage() + $loop->iteration }}
                </td>

                {{-- NAMA --}}
                <td>{{ $item->nama }}</td>

                {{-- JENIS KELAMIN --}}
                <td>
                  @if($item->jkl == 'L')
                    <span class="badge badge-info">
                      Laki-laki
                    </span>
                  @else
                    <span class="badge badge-warning">
                      Perempuan
                    </span>
                  @endif
                </td>

                {{-- NO HP --}}
                <td>{{ $item->no_tlp }}</td>

                {{-- ALAMAT --}}
                <td>{{ $item->alamat }}</td>

                {{-- CREATED --}}
                <td>
                  {{ optional($item->created_at)->format('d-m-Y') }}
                </td>

                {{-- UPDATED --}}
                <td>
                  {{ optional($item->updated_at)->format('d-m-Y') }}
                </td>

                {{-- ACTION --}}
                <td>

                  {{-- EDIT --}}
                  <a href="{{ route('pengarang.edit', $item->id) }}"
                     class="btn btn-warning btn-sm">

                    <i class="fas fa-edit"></i>


                  </a>

                  {{-- DELETE --}}
                  <form action="{{ route('pengarang.destroy', $item->id) }}"
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

              {{-- DATA KOSONG --}}
              @empty
              <tr>
                <td colspan="8" class="text-center">
                  Data pengarang tidak ditemukan
                </td>
              </tr>
              @endforelse

            </tbody>

          </table>

        </div>
      </div>

      {{-- FOOTER PAGINATION --}}
      <div class="card-footer text-right">

        {{ $pengarang->withQueryString()->onEachSide(1)->links() }}

      </div>

    </div>

  </div>
</div>
@endsection