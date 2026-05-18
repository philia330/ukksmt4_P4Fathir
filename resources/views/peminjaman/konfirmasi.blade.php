@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">
                <h4>Konfirmasi Peminjaman</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('peminjaman.updateKonfirmasi', $peminjaman->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    {{-- USER --}}
                    <div class="form-group">

                        <label>Peminjam</label>

                        <input type="text"
                               class="form-control"
                               value="{{ $peminjaman->user->name }}"
                               readonly>

                    </div>

                    {{-- BUKU --}}
                    <div class="form-group">

                        <label>Judul Buku</label>

                        <input type="text"
                               class="form-control"
                               value="{{ $peminjaman->buku->judul }}"
                               readonly>

                    </div>

                    {{-- FOTO --}}
                    <div class="form-group text-center">

                        <img src="{{ asset('uploads/buku/' . $peminjaman->buku->foto) }}"
                             width="200">

                    </div>

                    {{-- TANGGAL --}}
                    <div class="form-group">

                        <label>Tanggal Pinjam</label>

                        <input type="text"
                               class="form-control"
                               value="{{ $peminjaman->tanggal_pinjam }}"
                               readonly>

                    </div>

                    {{-- STATUS --}}
                    <div class="form-group">

                        <label>Status</label>

                        <select name="status"
                                class="form-control">

                            <option value="menunggu"
                                {{ $peminjaman->status == 'menunggu' ? 'selected' : '' }}>
                                Menunggu
                            </option>

                            <option value="dipinjam"
                                {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>
                                Dipinjam
                            </option>

                            <option value="dikembalikan"
                                {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>
                                Dikembalikan
                            </option>

                            <option value="terlambat"
                                {{ $peminjaman->status == 'terlambat' ? 'selected' : '' }}>
                                Terlambat
                            </option>

                        </select>

                    </div>

                    {{-- DENDA --}}
                    <div class="form-group">

                        <label>Denda</label>

                        <input type="number"
                               name="denda"
                               class="form-control"
                               value="{{ $peminjaman->denda }}">

                    </div>

                    <div class="text-right">

                        <a href="{{ route('peminjaman.transaksi') }}"
                           class="btn btn-secondary">

                            Kembali

                        </a>

                        <button class="btn btn-primary">

                            Simpan Konfirmasi

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection