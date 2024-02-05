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
                        <h3>Edit Masyarakat</h3>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">,
                        <div class="table-responsive p-0">
                            <form action="/Admin/updateMasyarakat/{{ $dataMasyarakat->id }}" method="post"
                                class="row px-4 py-5">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $dataMasyarakat->id }}">


                                <div class="form-group mb-4 col-md-6">
                                    <label for="nama_lengkap">Nama Lengkap:</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                        value="{{ $dataMasyarakat->name }}" placeholder="ENTER">
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ $dataMasyarakat->email }}">
                                </div>

                                <div class="form-group mb-4 col-md-6">
                                    <label for="password">Password:</label>
                                    <input type="text" class="form-control" id="password" name="password"
                                        value="{{ $dataMasyarakat->password }}" placeholder="ENTER">
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
