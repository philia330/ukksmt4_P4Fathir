@extends('layouts.app')

@section('content')

{{-- ===================================================== --}}
{{-- DASHBOARD ADMIN & PETUGAS --}}
{{-- ===================================================== --}}

@if(in_array(auth()->user()->role, ['admin', 'petugas']))

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

    {{-- TOTAL PEMINJAMAN --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">

        <div class="card card-statistic-1">

            <div class="card-icon bg-warning">

                <i class="fas fa-book-reader"></i>

            </div>

            <div class="card-wrap">

                <div class="card-header">

                    <h4>Total Peminjaman</h4>

                </div>

                <div class="card-body">

                    {{ $totalPeminjaman }}

                </div>

            </div>

        </div>

    </div>

    {{-- TOTAL DENDA --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">

        <div class="card card-statistic-1">

            <div class="card-icon bg-danger">

                <i class="fas fa-money-bill-wave"></i>

            </div>

            <div class="card-wrap">

                <div class="card-header">

                    <h4>Total Denda</h4>

                </div>

                <div class="card-body">

                    Rp {{ number_format($totalDenda, 0, ',', '.') }}

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ===================================================== --}}
{{-- STATUS TRANSAKSI --}}
{{-- ===================================================== --}}

<div class="row">

    {{-- MENUNGGU --}}
    <div class="col-lg-3 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <h6>Menunggu</h6>

                <h3 class="text-warning">

                    {{ $menunggu }}

                </h3>

            </div>

        </div>

    </div>

    {{-- DIPINJAM --}}
    <div class="col-lg-3 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <h6>Dipinjam</h6>

                <h3 class="text-primary">

                    {{ $dipinjam }}

                </h3>

            </div>

        </div>

    </div>

    {{-- DIKEMBALIKAN --}}
    <div class="col-lg-3 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <h6>Dikembalikan</h6>

                <h3 class="text-success">

                    {{ $dikembalikan }}

                </h3>

            </div>

        </div>

    </div>

    {{-- DITOLAK --}}
    <div class="col-lg-3 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <h6>Ditolak</h6>

                <h3 class="text-danger">

                    {{ $ditolak }}

                </h3>

            </div>

        </div>

    </div>

</div>

{{-- ===================================================== --}}
{{-- TRANSAKSI TERBARU --}}
{{-- ===================================================== --}}

<div class="card">

    <div class="card-header">

        <h4>Transaksi Terbaru</h4>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-striped table-md">

                <thead>

                    <tr>

                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Status</th>
                        <th>Tanggal</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($transaksiTerbaru as $item)

                    <tr>

                        {{-- PEMINJAM --}}
                        <td>

                            {{ $item->user->name }}

                        </td>

                        {{-- BUKU --}}
                        <td>

                            {{ $item->buku->judul }}

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

                        {{-- TANGGAL --}}
                        <td>

                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4"
                            class="text-center">

                            Belum ada transaksi

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- ===================================================== --}}
{{-- DASHBOARD ANGGOTA --}}
{{-- ===================================================== --}}

@elseif(auth()->user()->role == 'anggota')

<div class="row">

    @forelse($bukus as $buku)

    <div class="col-lg-3 col-md-4 col-sm-6">

        <div class="card">

            <div class="card-body text-center">

                {{-- FOTO --}}
                @if($buku->foto)

                    <img src="{{ asset('uploads/buku/' . $buku->foto) }}"
                         class="img-fluid rounded mb-3"
                         style="height:250px; width:100%; object-fit:cover;">

                @else

                    <div class="bg-light rounded p-5 mb-3">

                        Tidak ada foto

                    </div>

                @endif

                {{-- JUDUL --}}
                <h5>

                    {{ $buku->judul }}

                </h5>

                {{-- PENGARANG --}}
                <p class="mb-1">

                    <strong>Pengarang:</strong>

                    {{ $buku->pengarang->nama }}

                </p>

                {{-- PENERBIT --}}
                <p class="mb-1">

                    <strong>Penerbit:</strong>

                    {{ $buku->penerbit->nama }}

                </p>

            </div>

        </div>

    </div>

    @empty

    <div class="col-12">

        <div class="alert alert-warning text-center">

            Buku belum tersedia

        </div>

    </div>

    @endforelse

</div>

{{-- PAGINATION --}}
<div class="d-flex justify-content-end">

    {{ $bukus->links() }}

</div>

@endif

@endsection