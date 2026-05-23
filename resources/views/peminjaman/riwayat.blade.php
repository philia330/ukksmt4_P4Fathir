@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">

                <h4>Riwayat Peminjaman</h4>

            </div>

            {{-- BODY --}}
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-striped table-md">

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Foto</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Tanggal Dikembalikan</th>
                                <th>Status</th>
                                <th>Denda</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($peminjaman as $item)

                            <tr>

                                {{-- NOMOR --}}
                                <td>

                                    {{ ($peminjaman->currentPage() - 1)
                                        * $peminjaman->perPage()
                                        + $loop->iteration }}

                                </td>

                                {{-- FOTO --}}
                                <td>

                                    @if($item->buku->foto)

                                        <img src="{{ asset('uploads/buku/' . $item->buku->foto) }}"
                                             width="70">

                                    @else

                                        Tidak ada foto

                                    @endif

                                </td>

                                {{-- JUDUL --}}
                                <td>

                                    {{ $item->buku->judul }}

                                </td>

                                {{-- TANGGAL PINJAM --}}
                                <td>

                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}

                                </td>

                                {{-- TANGGAL KEMBALI --}}
                                <td>

                                    {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}

                                </td>

                                {{-- TANGGAL DIKEMBALIKAN --}}
                                <td>

                                    @if($item->tanggal_dikembalikan)

                                        {{ \Carbon\Carbon::parse($item->tanggal_dikembalikan)->format('d-m-Y') }}

                                    @else

                                        -

                                    @endif

                                </td>

{{-- STATUS --}}
<td>

    @php

        $hariIni = \Carbon\Carbon::now();

        $terlambat =
            $item->status == 'dipinjam'
            &&
            $hariIni->gt($item->tanggal_kembali);

    @endphp

    {{-- MENUNGGU --}}
    @if($item->status == 'menunggu')

        <span class="badge badge-warning">

            <i class="fas fa-clock"></i>

            Menunggu Konfirmasi

        </span>

    {{-- DIPINJAM --}}
    @elseif($item->status == 'dipinjam' && !$terlambat)

        <span class="badge badge-primary">

            <i class="fas fa-book-reader"></i>

            Sedang Dipinjam

        </span>

    {{-- TERLAMBAT --}}
    @elseif($terlambat)

        <span class="badge badge-danger">

            <i class="fas fa-exclamation-triangle"></i>

            Terlambat

        </span>

    {{-- DIKEMBALIKAN --}}
    @elseif($item->status == 'dikembalikan')

        <span class="badge badge-success">

            <i class="fas fa-check-circle"></i>

            Sudah Dikembalikan

        </span>

    {{-- DITOLAK --}}
    @elseif($item->status == 'ditolak')

        <span class="badge badge-dark">

            <i class="fas fa-times-circle"></i>

            Ditolak

        </span>

    {{-- PENGEMBALIAN DIAJUKAN --}}
    @elseif($item->status == 'pengembalian')

        <span class="badge badge-info">

            <i class="fas fa-undo"></i>

            Menunggu Verifikasi Pengembalian

        </span>

    @endif

</td>


                                {{-- DENDA --}}
                                <td>

                                    Rp {{ number_format($item->denda, 0, ',', '.') }}

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="8"
                                    class="text-center">

                                    Belum ada riwayat peminjaman

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- PAGINATION --}}
            <div class="card-footer text-right">

                {{ $peminjaman->onEachSide(1)->links() }}

            </div>

        </div>

    </div>
</div>

@endsection