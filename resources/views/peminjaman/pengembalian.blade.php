@extends('layouts.app')

@section('content')

<div class="row">

    @forelse($peminjaman as $item)

    <div class="col-lg-3 col-md-4 col-sm-6">

        <div class="card">

            {{-- FOTO --}}
            <img src="{{ asset('uploads/buku/' . $item->buku->foto) }}"
                 class="card-img-top"
                 style="height:300px; object-fit:cover;">

            <div class="card-body">

                {{-- JUDUL --}}
                <h5 class="card-title">

                    {{ $item->buku->judul }}

                </h5>

                {{-- TANGGAL PINJAM --}}
                <p>

                    <b>Tanggal Pinjam:</b><br>

                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}

                </p>

                {{-- TANGGAL KEMBALI --}}
                <p>

                    <b>Batas Kembali:</b><br>

                    {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}

                </p>

                {{-- BUTTON --}}
                <form action="{{ route('peminjaman.kembalikan', $item->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <button class="btn btn-success btn-block">

                        <i class="fas fa-undo"></i>

                        Kembalikan

                    </button>

                </form>

            </div>

        </div>

    </div>

    @empty

    <div class="col-12">

        <div class="alert alert-info">

            Tidak ada buku yang sedang dipinjam

        </div>

    </div>

    @endforelse

</div>

@endsection