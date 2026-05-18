@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')

<div class="section-header">
    <h1>Detail Buku</h1>
</div>

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-body">

                <div class="row">

                    {{-- FOTO --}}
                    <div class="col-md-4 text-center">

                        <img src="{{ asset('uploads/buku/' . $buku->foto) }}"
                             class="img-fluid rounded"
                             style="height:350px; object-fit:cover;">

                    </div>

                    {{-- DETAIL --}}
                    <div class="col-md-8">

                        <h3>{{ $buku->judul }}</h3>

                        <hr>

                        <p>
                            <b>Genre :</b>
                            {{ $buku->genre->nama }}
                        </p>

                        <p>
                            <b>Pengarang :</b>
                            {{ $buku->pengarang->nama }}
                        </p>

                        <p>
                            <b>Penerbit :</b>
                            {{ $buku->penerbit->nama }}
                        </p>

                        <p>
                            <b>Tahun :</b>
                            {{ $buku->tahun }}
                        </p>

                        <p>
                            <b>Stok :</b>

                            @if($buku->stok > 0)

                                <span class="badge badge-primary">
                                    {{ $buku->stok }}
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    Habis
                                </span>

                            @endif
                        </p>

                    </div>

                </div>

                <hr>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-between">

                    {{-- KEMBALI --}}
                    <a href="{{ route('peminjaman.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>
                        Kembali

                    </a>

                    {{-- LANJUTKAN --}}
                    @if($buku->stok > 0)

                    <form action="{{ route('peminjaman.store') }}"
                          method="POST">

                        @csrf

                        <input type="hidden"
                               name="id_buku"
                               value="{{ $buku->id }}">

                        <button type="submit"
                                class="btn btn-success">

                            <i class="fas fa-check"></i>
                            Lanjutkan

                        </button>

                    </form>

                    @else

                    <button class="btn btn-danger" disabled>
                        Buku Tidak Tersedia
                    </button>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection