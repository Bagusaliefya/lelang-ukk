@extends('layouts.bone')
@section('title')
@section('content')
    @include('includes.footer')
    @include('includes.navbar')
    @include('includes.sidebar')
    <style>
        /* Gaya untuk kartu lelang */
        .lelang-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        /* Efek hover */
        .lelang-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk input amount, tombol bid, dan lainnya */
        .bid-input {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .bid-button {
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .bid-button:hover {
            background-color: #18b300;
        }

        /* Gaya untuk tombol kecil */
        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-sm:hover {
            background-color: #0056b3;
        }
    </style>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8"> <!-- Content area -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('petugas-user') }}" method="get">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <select class="form-select" name="sort_by" onchange="this.form.submit()">
                                    <option value="all" @if ($sort_by == 'all') selected @endif>Semua</option>
                                    <option value="high" @if ($sort_by == 'high') selected @endif>Penawaran
                                        Tertinggi</option>
                                    <option value="low" @if ($sort_by == 'low') selected @endif>Penawaran
                                        Terendah</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" name="barang" onchange="this.form.submit()">
                                    <option value="">Pilih Barang</option>
                                    @foreach ($dataLelang as $lelang)
                                        <option value="{{ $lelang->barang->id_barang }}"
                                            @if ($barang == $lelang->barang->id_barang) selected @endif>
                                            {{ $lelang->barang->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                    </form>



                    @if ($dataUser->count() > 0)
                        <div class="row">
                            @foreach ($dataUser as $data)
                                @if ($data->lelang->status == 'dibuka')
                                    <div class="col-md-4 mb-4">
                                        <div class="card lelang-card">
                                            <!-- Tambahkan kelas lelang-card -->
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $data->barang->nama_barang }}</h5>
                                                <p class="card-text">{{ $data->barang->deskripsi_barang }}</p>
                                                <p class="card-text">Harga: {{ $data->barang->harga_awal }}</p>
                                                <p class="card-text">Harga Penawaran: {{ $data->penawaran_harga }}</p>
                                                <p class="card-text">Pelelang: {{ $data->user->name }}</p>
                                                <a href="{{ route('lelang.update', $data->id_lelang) }}"
                                                    class="btn btn-primary">Konfirmasi
                                                    Pemenang</a href="">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p>Tidak ada data lelang.</p>
                    @endif

                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
@endsection
