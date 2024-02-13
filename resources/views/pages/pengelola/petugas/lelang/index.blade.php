    <!--
    =========================================================
    * Soft UI Dashboard - v1.0.7
    =========================================================

    * Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
    * Copyright 2023 Creative Tim (https://www.creative-tim.com)
    * Licensed under MIT (https://www.creative-tim.com/license)
    * Coded by Creative Tim

    =========================================================

    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->

    @extends('layouts.bone')
    @section('title')
    @section('content')
        @include('includes.footer')
        @include('includes.navbar')
        @include('includes.sidebar')



        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0" style="text-align: center">
                            <h3>Tambah Barang Lelang</h3>

                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <form action="{{ route('petugas.tambahLelang') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="id_lelang">ID Lelang:</label>
                                            <input type="text" class="form-control" id="id_lelang" name="id_lelang"
                                                placeholder="Enter ID Barang">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang:</label>
                                            <select name="id_barang" class="form-control">
                                                @foreach ($dataBarang as $data)
                                                    <option value="{{ $data->id_barang }}">
                                                        {{ $data->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal_lelang">tanggal:</label>
                                            <input type="date" class="form-control" id="tanggal_lelang"
                                                name="tanggal_lelang">
                                        </div>



                                        <button type="button" class="btn btn-secondary me-2"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Data Lelang</h6>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('  error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Id Lelang</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Barang</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Harga Awal</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Harga Akhir</th>


                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Pemenang</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataLelang as $lelang)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $lelang->id_lelang }}</td>
                                                <td>
                                                    {{ $lelang->barang->nama_barang }}
                                                </td>

                                                <td>{{ $lelang->tanggal_lelang }}</td>
                                                <td>
                                                    {{ $lelang->barang->harga_awal }}
                                                </td>

                                                <td>{{ $lelang->harga_akhir }}</td>
                                                <td>
                                                    {{ $lelang->user->name ?? 'belum ada pemenang' }}
                                                </td>

                                                <td>{{ $lelang->status }}</td>



                                                <td>
                                                    <!-- Tambahkan tombol hapus -->
                                                    <a href="{{ route('petugas.hapusLelang', $lelang->id_lelang) }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
                <i class="fa fa-cog py-2"> </i>
            </a>
            <div class="card shadow-lg ">
                <div class="card-header pb-0 pt-3 ">
                    <div class="float-start">
                        <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
                        <p>See our dashboard options.</p>
                    </div>
                    <div class="float-end mt-4">
                        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <!-- End Toggle Button -->
                </div>
                <hr class="horizontal dark my-1">
                <div class="card-body pt-sm-3 pt-0">
                    <!-- Sidebar Backgrounds -->
                    <div>
                        <h6 class="mb-0">Sidebar Colors</h6>
                    </div>
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors my-2 text-start">
                            <span class="badge filter bg-gradient-primary active" data-color="primary"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-dark" data-color="dark"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-info" data-color="info"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-success" data-color="success"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-warning" data-color="warning"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-danger" data-color="danger"
                                onclick="sidebarColor(this)"></span>
                        </div>
                    </a>
                    <!-- Sidenav Type -->
                    <div class="mt-3">
                        <h6 class="mb-0">Sidenav Type</h6>
                        <p class="text-sm">Choose between 2 different sidenav types.</p>
                    </div>
                    <div class="d-flex">
                        <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent"
                            onclick="sidebarType(this)">Transparent</button>
                        <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white"
                            onclick="sidebarType(this)">White</button>
                    </div>
                    <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                    <!-- Navbar Fixed -->
                    <div class="mt-3">
                        <h6 class="mb-0">Navbar Fixed</h6>
                    </div>
                    <div class="form-check form-switch ps-0">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                    <hr class="horizontal dark my-sm-4">
                    <a class="btn bg-gradient-dark w-100"
                        href="https://www.creative-tim.com/product/soft-ui-dashboard">Free
                        Download</a>
                    <a class="btn btn-outline-dark w-100"
                        href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View
                        documentation</a>
                    <div class="w-100 text-center">
                        <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard"
                            data-icon="octicon-star" data-size="large" data-show-count="true"
                            aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
                        <h6 class="mt-3">Thank you for sharing!</h6>
                        <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard"
                            class="btn btn-dark mb-0 me-2" target="_blank">
                            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard"
                            class="btn btn-dark mb-0 me-2" target="_blank">
                            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                        </a>
                    </div>
                </div>
            </div>
        </div>


    @endsection
