@extends('layouts.bone')
@section('title', 'Lelang')

@section('content')
    @include('includes.navbar')

    <div class="container mt-4">
        <h2>Daftar Lelang</h2>

        @if ($dataLelang->count() > 0)
            <div class="row">
                @foreach ($dataLelang as $lelang)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $lelang->barang->image }}" class="card-img-top" alt="{{ $lelang->judul }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $lelang->barang->nama_barang }}</h5>
                                <p class="card-text">{{ $lelang->deskripsi }}</p>
                                <p class="card-text">Harga: {{ $lelang->harga_awal }}</p>

                                <!-- Tombol Bid -->
                                <form action="" method="post">
                                    @csrf

                                    <button type="submit" class="btn btn-primary">Bid</button>
                                </form>
                                <!-- Akhir Tombol Bid -->

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Tidak ada data lelang.</p>
        @endif
    </div>

    @include('includes.footer')
@endsection
