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
                            <img src="{{ $lelang->gambar }}" class="card-img-top" alt="{{ $lelang->judul }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $lelang->judul }}</h5>
                                <p class="card-text">{{ $lelang->deskripsi }}</p>
                                <p class="card-text">Harga Awal: {{ $lelang->harga_awal }}</p>
                                <a href="{{ route('lelang.show', $lelang->id) }}" class="btn btn-primary">Detail</a>
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
