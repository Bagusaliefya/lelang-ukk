@extends('layouts.bone')
@section('title', 'Lelang')

@section('content')
    @include('includes.navbar')

    <style>
        /* Gaya untuk kartu lelang */
        .lelang-card {
            border: 1px solid #ccc;
            /* Warna border */
            border-radius: 10px;
            /* Sudut border */
            overflow: hidden;
            /* Agar gambar tidak melebihi batas border */
            transition: transform 0.3s ease;
            /* Transisi saat hover */
        }

        /* Efek hover */
        .lelang-card:hover {
            transform: translateY(-5px);
            /* Menggeser kartu ke atas saat hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Efek bayangan */
        }

        /* Gaya untuk input amount */
        .bid-input {
            width: calc(100% - 20px);
            /* Lebar input dikurangi dengan margin */
            padding: 8px;
            margin-bottom: 10px;
            /* Tambahkan margin bawah */
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Gaya untuk tombol bid */
        .bid-button {
            width: calc(100% - 20px);
            /* Lebar tombol dikurangi dengan margin */
            padding: 10px;
            background-color: #007bff;
            /* Warna latar tombol */
            color: #fff;
            /* Warna teks tombol */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            /* Transisi saat hover */
        }

        /* Efek hover pada tombol bid */
        .bid-button:hover {
            background-color: #18b300;
            /* Warna latar tombol saat hover */
        }
    </style>

    <div class="container mt-4">

        <h2>Daftar Lelang</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        @if ($dataLelang->count() > 0)
            <div class="row">
                @foreach ($dataLelang as $lelang)
                    <div class="col-md-4 mb-4">
                        <div class="card lelang-card"> <!-- Tambahkan kelas lelang-card -->
                            <img src="{{ $lelang->barang->image }}" class="card-img-top" alt="{{ $lelang->judul }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $lelang->barang->nama_barang }}</h5>
                                <p class="card-text">{{ $lelang->deskripsi }}</p>
                                <p class="card-text">Harga: {{ $lelang->harga_awal }}</p>
                                <p class="card-text"> BID
                                    Tertinggi:{{ $lelang->history->isEmpty() ? 'Belum ada penawaran' : $lelang->history->sortByDesc('penawaran_harga')->first()->penawaran_harga }}
                                </p>

                                <!-- Form bid -->
                                <form action="{{ route('masyarakat.bid') }}" method="post">
                                    @csrf
                                    <input type="text" name="penawaran_harga" id="penawaran_harga"
                                        placeholder="Masukkan jumlah bid" class="bid-input" required>

                                    <input type="hidden" name="id_lelang" id="id_lelang" value="{{ $lelang->id_lelang }}">
                                    <input type="hidden" name="id_barang" id="id_barang" value="{{ $lelang->id_barang }}">
                                    <input type="hidden" name="id_user" id="id_user" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="bid-button">Bid</button>
                                </form>
                                <!-- Akhir form bid -->

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
