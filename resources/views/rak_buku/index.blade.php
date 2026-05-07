@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">

    {{-- ALERT --}}
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

        <h4>Data Rak Buku</h4>

        <div class="d-flex">

          {{-- SEARCH --}}
          <form method="GET"
                action="{{ route('rak_buku.index') }}"
                class="mr-2">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari lokasi rak..."
                   value="{{ request('search') }}">

          </form>

          {{-- RESET --}}
          <a href="{{ route('rak_buku.index') }}"
             class="btn btn-secondary mr-2">

            Reset

          </a>

          {{-- TAMBAH --}}
          <a href="{{ route('rak_buku.create') }}"
             class="btn btn-primary">

            + Tambah Rak Buku

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
                <th>Lokasi Rak</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              @forelse($rak_buku as $item)
              <tr>

                {{-- NOMOR --}}
                <td>
                  {{ ($rak_buku->currentPage() - 1) * $rak_buku->perPage() + $loop->iteration }}
                </td>

                {{-- LOKASI --}}
                <td>{{ $item->lokasi }}</td>

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
                  <a href="{{ route('rak_buku.edit', $item->id) }}"
                     class="btn btn-warning btn-sm">

                    Edit

                  </a>

                  {{-- DELETE --}}
                  <form action="{{ route('rak_buku.destroy', $item->id) }}"
                        method="POST"
                        style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data?')">

                      Delete

                    </button>

                  </form>

                </td>

              </tr>

              {{-- DATA KOSONG --}}
              @empty
              <tr>

                <td colspan="5"
                    class="text-center">

                  Data rak buku tidak ditemukan

                </td>

              </tr>
              @endforelse

            </tbody>

          </table>

        </div>

      </div>

      {{-- FOOTER PAGINATION --}}
      <div class="card-footer text-right">

        {{ $rak_buku->withQueryString()->links() }}

      </div>

    </div>

  </div>
</div>
@endsection