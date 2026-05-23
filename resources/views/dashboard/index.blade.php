@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')

<div class="row">

{{-- ===================================================== --}}
{{-- DASHBOARD ADMIN & PETUGAS --}}
{{-- ===================================================== --}}
@if(auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')

<div class="row">

  {{-- TOTAL BUKU --}}
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">

    <div class="card card-statistic-1">

      <div class="card-icon bg-primary">
        <i class="fas fa-book"></i>
      </div>

      <div class="card-wrap">

        <div class="card-header">
          <h4>Total Buku</h4>
        </div>

        <div class="card-body">
          {{ $totalBuku }}
        </div>

      </div>

    </div>

  </div>

  {{-- TOTAL ANGGOTA --}}
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">

    <div class="card card-statistic-1">

      <div class="card-icon bg-success">
        <i class="fas fa-users"></i>
      </div>

      <div class="card-wrap">

        <div class="card-header">
          <h4>Total Anggota</h4>
        </div>

        <div class="card-body">
          {{ $totalAnggota }}
        </div>

      </div>

    </div>

  </div>

  {{-- TOTAL PENGARANG --}}
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">

    <div class="card card-statistic-1">

      <div class="card-icon bg-warning">
        <i class="fas fa-pen-nib"></i>
      </div>

      <div class="card-wrap">

        <div class="card-header">
          <h4>Total Pengarang</h4>
        </div>

        <div class="card-body">
          {{ $totalPengarang }}
        </div>

      </div>

    </div>

  </div>

  {{-- TOTAL PENERBIT --}}
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">

    <div class="card card-statistic-1">

      <div class="card-icon bg-danger">
        <i class="fas fa-building"></i>
      </div>

      <div class="card-wrap">

        <div class="card-header">
          <h4>Total Penerbit</h4>
        </div>

        <div class="card-body">
          {{ $totalPenerbit }}
        </div>

      </div>

    </div>

  </div>

</div>

{{-- TABLE BUKU --}}
<div class="card">

  <div class="card-header">
    <h4>Stok Buku Terbaru</h4>
  </div>

  <div class="card-body p-0">

    <div class="table-responsive">

      <table class="table table-striped table-md mb-0">

        <thead>
          <tr>

            <th>#</th>
            <th>Foto</th>
            <th>Judul Buku</th>
            <th>Stok</th>

          </tr>
        </thead>

        <tbody>

          @forelse($bukuTerbaru as $item)
          <tr>

            {{-- NOMOR --}}
            <td>
              {{ ($bukuTerbaru->currentPage() - 1) * $bukuTerbaru->perPage() + $loop->iteration }}
            </td>

            {{-- FOTO --}}
            <td>

              @if($item->foto)

                <img src="{{ asset('uploads/buku/' . $item->foto) }}"
                     width="60"
                     class="rounded">

              @else

                Tidak ada foto

              @endif

            </td>

            {{-- JUDUL --}}
            <td>
              {{ $item->judul }}
            </td>

            {{-- STOK --}}
            <td>

              @if($item->stok < 5)

                <span class="badge badge-danger">

                  {{ $item->stok }}

                </span>

              @else

                <span class="badge badge-primary">

                  {{ $item->stok }}

                </span>

              @endif

            </td>

          </tr>

          @empty

          <tr>

            <td colspan="4"
                class="text-center">

              Data buku belum tersedia

            </td>

          </tr>

          @endforelse

        </tbody>

      </table>

    </div>

  </div>

  <div class="card-footer text-right">

    {{ $bukuTerbaru->onEachSide(1)->links() }}

  </div>

</div>

{{-- ===================================================== --}}
{{-- DASHBOARD ANGGOTA --}}
{{-- ===================================================== --}}
@elseif(auth()->user()->role == 'anggota')

<div class="col-12">

  <div class="card">

    <div class="card-header">
      <h4>Katalog Buku</h4>
    </div>

    <div class="card-body">

      <div class="row">

        @forelse($bukuTerbaru as $item)

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

          <div class="card shadow-sm border-0 h-100">

            {{-- FOTO BUKU --}}
            @if($item->foto)

              <img src="{{ asset('uploads/buku/' . $item->foto) }}"
                   class="card-img-top"
                   style="height: 320px;
                          object-fit: cover;">

            @else

              <img src="https://via.placeholder.com/300x320"
                   class="card-img-top">

            @endif

            {{-- BODY --}}
            <div class="card-body">

              {{-- JUDUL --}}
              <h6 class="font-weight-bold mb-2">

                {{ $item->judul }}

              </h6>

              {{-- PENGARANG --}}
              <p class="mb-1 text-muted">

                <i class="fas fa-user-edit"></i>

                {{ $item->pengarang->nama }}

              </p>

              {{-- PENERBIT --}}
              <p class="mb-0 text-muted">

                <i class="fas fa-building"></i>

                {{ $item->penerbit->nama }}

              </p>

            </div>

          </div>

        </div>

        @empty

        <div class="col-12">

          <div class="alert alert-danger text-center">

            Buku belum tersedia

          </div>

        </div>

        @endforelse

      </div>

    </div>

    {{-- PAGINATION --}}
    <div class="card-footer text-right">

      {{ $bukuTerbaru->onEachSide(1)->links() }}

    </div>

  </div>

</div>

@endif

</div>

@endsection