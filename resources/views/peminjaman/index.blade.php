@extends('layouts.app')

@section('title', 'Peminjaman Buku')

@section('content')

@if(session('success'))

<div class="alert alert-warning alert-dismissible fade show">

    {{ session('success') }}

    <button type="button"
            class="close"
            data-dismiss="alert">

        &times;

    </button>

</div>

@endif

<div class="row">

@foreach($bukus as $buku)
<div class="col-lg-3 col-md-4 col-sm-6">

    <div class="card">

        <div class="card-body text-center">

            {{-- FOTO --}}
<img src="{{ asset('uploads/buku/' . $buku->foto) }}"
     alt=""
     class="img-fluid mb-3"
     style="height: 220px; object-fit: cover; width:100%; border-radius:10px;">

            {{-- JUDUL --}}
            <h6>{{ $buku->judul }}</h6>

            {{-- STOK --}}
            @if($buku->stok > 0)
                <div class="badge badge-primary mb-2">
                    Stok : {{ $buku->stok }}
                </div>
            @else
                <div class="badge badge-danger mb-2">
                    Stok Habis
                </div>
            @endif

            {{-- BUTTON --}}
            @if($buku->stok > 0)

                <a href="{{ route('peminjaman.show', $buku->id) }}"
   class="btn btn-success btn-block">

    <i class="fas fa-book"></i>
    Pinjam

</a>
            @else

                <button class="btn btn-secondary btn-block" disabled>
                    Tidak Tersedia
                </button>

            @endif

        </div>

    </div>

</div>
@endforeach

</div>

<div class="d-flex justify-content-center">
    {{ $bukus->links() }}
</div>

@endsection