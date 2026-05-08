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
        <h4>Data Genre</h4>

        <div class="d-flex">

          {{-- SEARCH --}}
          <form method="GET" action="{{ route('genre.index') }}" class="mr-2">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari genre..."
                   value="{{ request('search') }}">
          </form>

          {{-- RESET --}}
          <a href="{{ route('genre.index') }}"
             class="btn btn-secondary mr-2">
            Reset
          </a>

          {{-- TAMBAH --}}
          <a href="{{ route('genre.create') }}"
             class="btn btn-primary">
            + Tambah Genre
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
                <th>Nama Genre</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              @forelse($genre as $item)
              <tr>

                {{-- NOMOR --}}
                <td>
                  {{ ($genre->currentPage() - 1) * $genre->perPage() + $loop->iteration }}
                </td>

                {{-- NAMA --}}
                <td>{{ $item->nama }}</td>

                {{-- TANGGAL --}}
                <td>{{ optional($item->created_at)->format('d-m-Y') }}</td>

                <td>{{ optional($item->updated_at)->format('d-m-Y') }}</td>

                {{-- ACTION --}}
                <td>

                  {{-- EDIT --}}
                  <a href="{{ route('genre.edit', $item->id) }}"
                     class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i>
                  </a>

                  {{-- DELETE --}}
                  <form action="{{ route('genre.destroy', $item->id) }}"
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
                <td colspan="5" class="text-center">
                  Data genre tidak ditemukan
                </td>
              </tr>
              @endforelse

            </tbody>

          </table>

        </div>
      </div>

      {{-- PAGINATION --}}
      <div class="card-footer text-right">
        {{ $genre->withQueryString()->onEachSide(1)->links() }}
      </div>

    </div>

  </div>
</div>
@endsection