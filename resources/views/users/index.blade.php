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
        <h4>Data User</h4>

        <div class="d-flex">

          {{-- SEARCH --}}
          <form method="GET" action="{{ route('users.index') }}" class="mr-2">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari user..." value="{{ request('search') }}">
          </form>

          {{-- RESET --}}
          <a href="{{ route('users.index') }}" class="btn btn-secondary mr-2">
            Reset
          </a>

          {{-- TAMBAH --}}
          <a href="{{ route('users.create') }}" class="btn btn-primary">
            + Tambah User
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
                <th>Email</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>JKL</th>
                <th>Role</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse($users as $user)
              <tr>
                <td>
                  {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                </td>

                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->no_tlp }}</td>
                <td>{{ $user->alamat }}</td>

                {{-- JKL --}}
                <td>
                  @if($user->jkl == 'L')
                    <span class="badge badge-info">Laki-laki</span>
                  @else
                    <span class="badge badge-warning">Perempuan</span>
                  @endif
                </td>

                {{-- ROLE --}}
                <td>
                  @if($user->role == 'admin')
                    <span class="badge badge-success">Admin</span>
                  @elseif($user->role == 'petugas')
                    <span class="badge badge-primary">Petugas</span>
                  @else
                    <span class="badge badge-secondary">Anggota</span>
                  @endif
                </td>

                {{-- DATE --}}
                <td>{{ optional($user->created_at)->format('d-m-Y') }}</td>
                <td>{{ optional($user->updated_at)->format('d-m-Y') }}</td>

                {{-- ACTION --}}
                <td>
                  <a href="{{ route('users.edit', $user->id) }}"
                     class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i>
                    </a>

                  <form action="{{ route('users.destroy', $user->id) }}"
                        method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus?')">
                     <i class="fas fa-trash"></i>

                    </button>
                  </form>
                </td>
              </tr>

              {{-- KALAU DATA KOSONG --}}
              @empty
              <tr>
                <td colspan="10" class="text-center">
                  Data tidak ditemukan
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>

        </div>
      </div>

      {{-- FOOTER PAGINATION --}}
      <div class="card-footer text-right">
        {{ $users->withQueryString()->onEachSide(1)->links() }}
      </div>

    </div>

  </div>
</div>
@endsection