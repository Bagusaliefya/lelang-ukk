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



    <div class="container-fluid py-4">
        <div class="row mx-auto p-5">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0" style="text-align: center">
                        <h3>Edit Data</h3>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form action="/Admin/updateData/{{ $dataBarang->id_barang }}" method="post"
                                class="row px-4 py-5">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $dataBarang->id_barang }}">

                                <div class="form-group mb-4 col-md-6">
                                    <label for="id_barang">ID Barang:</label>
                                    <input type="text" class="form-control" id="id_barang" name="id_barang"
                                        value="{{ $dataBarang->id_barang }}" placeholder="Enter ID Barang">
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="nama_barang">Nama Barang:</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                        value="{{ $dataBarang->nama_barang }}" placeholder="Enter Nama Barang">
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="tanggal">Tanggal:</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                                        value="{{ $dataBarang->tanggal }}">
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="harga_awal">Harga:</label>
                                    <input type="text" class="form-control" id="harga_awal" name="harga_awal"
                                        value="{{ $dataBarang->harga_awal }}" placeholder="Enter harga">
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="deskripsi_barang">Deskripsi:</label>
                                    <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang" placeholder="Enter Deskripsi">{{ $dataBarang->deskripsi_barang }}</textarea>
                                </div>



                                <div class="d-flex justify-content-center flex-column">
                                    <button type="submit" class="btn btn-success my-3 w-100">Submit</button>
                                    <button type="button" class="btn btn-secondary  w-100"
                                        data-dismiss="modal">Cancel</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
