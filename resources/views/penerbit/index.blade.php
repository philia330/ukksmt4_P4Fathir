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

        <h4>Data Penerbit</h4>

        <div class="d-flex">

          {{-- SEARCH --}}
          <form method="GET"
                action="{{ route('penerbit.index') }}"
                class="mr-2">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari penerbit..."
                   value="{{ request('search') }}">

          </form>

          {{-- RESET --}}
          <a href="{{ route('penerbit.index') }}"
             class="btn btn-secondary mr-2">

            Reset

          </a>

          {{-- TAMBAH --}}
          <a href="{{ route('penerbit.create') }}"
             class="btn btn-primary">

            + Tambah Penerbit

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
                <th>Alamat</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              @forelse($penerbit as $item)
              <tr>

                <td>
                  {{ ($penerbit->currentPage() - 1) * $penerbit->perPage() + $loop->iteration }}
                </td>

                <td>{{ $item->nama }}</td>

                <td>{{ $item->alamat }}</td>

                <td>
                  {{ optional($item->created_at)->format('d-m-Y') }}
                </td>

                <td>
                  {{ optional($item->updated_at)->format('d-m-Y') }}
                </td>

                <td>

                  <a href="{{ route('penerbit.edit', $item->id) }}"
                     class="btn btn-warning btn-sm">

                    <i class="fas fa-edit"></i>


                  </a>

                  <form action="{{ route('penerbit.destroy', $item->id) }}"
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

                <td colspan="6"
                    class="text-center">

                  Data penerbit tidak ditemukan

                </td>

              </tr>
              @endforelse

            </tbody>

          </table>

        </div>

      </div>

      {{-- PAGINATION --}}
      <div class="card-footer text-right">

        {{ $penerbit->withQueryString()->onEachSide(1)->links() }}

      </div>

    </div>

  </div>
</div>
@endsection