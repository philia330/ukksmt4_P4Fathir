@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

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

        {{-- ALERT ERROR --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show">

                {{ session('error') }}

                <button type="button"
                        class="close"
                        data-dismiss="alert">

                    &times;

                </button>

            </div>

        @endif

        <div class="card shadow">

            {{-- HEADER --}}
            <div class="card-header">

                <h4>Konfirmasi Peminjaman</h4>

            </div>

            {{-- BODY --}}
            <div class="card-body">

                <form action="{{ route('peminjaman.updateKonfirmasi', $peminjaman->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    {{-- PEMINJAM --}}
                    <div class="form-group">

                        <label>Peminjam</label>

                        <input type="text"
                               class="form-control"
                               value="{{ $peminjaman->user->name }}"
                               readonly>

                    </div>

                    {{-- JUDUL BUKU --}}
                    <div class="form-group">

                        <label>Judul Buku</label>

                        <input type="text"
                               class="form-control"
                               value="{{ $peminjaman->buku->judul }}"
                               readonly>

                    </div>

                    {{-- FOTO --}}
                    <div class="form-group text-center">

                        @if($peminjaman->buku->foto)

                            <img src="{{ asset('uploads/buku/' . $peminjaman->buku->foto) }}"
                                 width="220"
                                 class="rounded shadow">

                        @else

                            <p>Tidak ada foto</p>

                        @endif

                    </div>

                    {{-- TANGGAL PINJAM --}}
                    <div class="form-group">

                        <label>Tanggal Pinjam</label>

                        <input type="text"
                               class="form-control"
                               value="{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}"
                               readonly>

                    </div>

                    {{-- BATAS PENGEMBALIAN --}}
                    <div class="form-group">

                        <label>Batas Pengembalian</label>

                        <input type="text"
                               class="form-control"
                               value="{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') }}"
                               readonly>

                    </div>

                    {{-- TANGGAL DIKEMBALIKAN --}}
                    <div class="form-group">

                        <label>Tanggal Dikembalikan</label>

                        <input type="text"
                               class="form-control"

                               value="
                               @if($peminjaman->tanggal_dikembalikan)

                                   {{ \Carbon\Carbon::parse($peminjaman->tanggal_dikembalikan)->format('d-m-Y') }}

                               @else

                                   Belum Dikembalikan

                               @endif
                               "

                               readonly>

                    </div>

                    {{-- STATUS --}}
                    <div class="form-group">

                        <label>Status</label>

                        <select name="status"
                                class="form-control">

                            {{-- MENUNGGU --}}
                            <option value="menunggu"
                                {{ $peminjaman->status == 'menunggu' ? 'selected' : '' }}>

                                Menunggu

                            </option>

                            {{-- DIPINJAM --}}
                            <option value="dipinjam"
                                {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>

                                Dipinjam

                            </option>

                            {{-- PENGEMBALIAN --}}
                            <option value="pengembalian"
                                {{ $peminjaman->status == 'pengembalian' ? 'selected' : '' }}>

                                Menunggu Pengembalian

                            </option>

                            {{-- DIKEMBALIKAN --}}
                            <option value="dikembalikan"
                                {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>

                                Dikembalikan

                            </option>

                            {{-- DITOLAK --}}
                            <option value="ditolak"
                                {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>

                                Ditolak

                            </option>

                        </select>

                    </div>

                    {{-- DENDA --}}
                    <div class="form-group">

                        <label>Denda</label>

                        <input type="number"
                               name="denda"
                               class="form-control"
                               min="0"
                               value="{{ $peminjaman->denda ?? 0 }}">

                    </div>

                    {{-- BUTTON --}}
                    <div class="text-right">

                        <a href="{{ route('peminjaman.transaksi') }}"
                           class="btn btn-secondary">

                            Kembali

                        </a>

                        <button type="submit"
                                class="btn btn-primary">

                            Simpan Konfirmasi

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection