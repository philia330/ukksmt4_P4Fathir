@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-12">

    {{-- ALERT SUCCESS --}}
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

        <h4>Transaksi Peminjaman</h4>

        <div class="d-flex">

          {{-- SEARCH --}}
          <form method="GET"
                action="{{ route('peminjaman.transaksi') }}"
                class="mr-2">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari peminjaman..."
                   value="{{ request('search') }}">

          </form>

          {{-- RESET --}}
          <a href="{{ route('peminjaman.transaksi') }}"
             class="btn btn-secondary">

            Reset

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
                <th>Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tanggal Dikembalikan</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Action</th>

              </tr>

            </thead>

            <tbody>

              @forelse($peminjaman as $item)

              <tr>

                {{-- NOMOR --}}
                <td>
                  {{ ($peminjaman->currentPage() - 1) * $peminjaman->perPage() + $loop->iteration }}
                </td>

                {{-- FOTO --}}
                <td>

                  @if($item->buku->foto)

                    <img src="{{ asset('uploads/buku/' . $item->buku->foto) }}"
                         width="70"
                         class="rounded">

                  @else

                    Tidak ada foto

                  @endif

                </td>

                {{-- PEMINJAM --}}
                <td>
                  {{ $item->user->name }}
                </td>

                {{-- JUDUL --}}
                <td>
                  {{ $item->buku->judul }}
                </td>

                {{-- TANGGAL PINJAM --}}
                <td>
                  {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}
                </td>

                {{-- BATAS KEMBALI --}}
                <td>
                  {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}
                </td>

                {{-- TANGGAL DIKEMBALIKAN --}}
                <td>

                  @if($item->tanggal_dikembalikan)

                    {{ \Carbon\Carbon::parse($item->tanggal_dikembalikan)->format('d-m-Y') }}

                  @else

                    <span class="badge badge-secondary">

                      Belum Dikembalikan

                    </span>

                  @endif

                </td>

                {{-- STATUS --}}
                <td>

                  @if($item->status == 'menunggu')

                    <span class="badge badge-warning">
                      Menunggu
                    </span>

                  @elseif($item->status == 'dipinjam')

                    <span class="badge badge-primary">
                      Dipinjam
                    </span>

                    @elseif($item->status == 'pengembalian')

                    <span class="badge badge-info">
                        Pengajuan Pengembalian
                    </span>

                  @elseif($item->status == 'dikembalikan')

                    <span class="badge badge-success">
                      Dikembalikan
                    </span>

                  @elseif($item->status == 'ditolak')

                    <span class="badge badge-danger">
                      Ditolak
                    </span>

                  @endif

                </td>

                {{-- DENDA --}}
                <td>

                  @if($item->denda > 0)

                    <span class="badge badge-danger">

                      Rp {{ number_format($item->denda, 0, ',', '.') }}

                    </span>

                  @else

                    <span class="badge badge-success">

                      Tidak Ada

                    </span>

                  @endif

                </td>

                {{-- ACTION --}}
                <td>

                  {{-- EDIT --}}
                  <a href="{{ route('peminjaman.konfirmasi', $item->id) }}"
                     class="btn btn-primary btn-sm">

                    <i class="fas fa-edit"></i>

                  </a>

                  {{-- DELETE --}}
                  <form action="{{ route('peminjaman.destroy', $item->id) }}"
                        method="POST"
                        style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus transaksi?')">

                      <i class="fas fa-trash"></i>

                    </button>

                  </form>

                </td>

              </tr>

              @empty

              <tr>

                <td colspan="10"
                    class="text-center">

                  Data peminjaman tidak ditemukan

                </td>

              </tr>

              @endforelse

            </tbody>

          </table>

        </div>

      </div>

      {{-- PAGINATION --}}
      <div class="card-footer text-right">

        {{ $peminjaman->withQueryString()->onEachSide(1)->links() }}

      </div>

    </div>

  </div>
</div>

@endsection