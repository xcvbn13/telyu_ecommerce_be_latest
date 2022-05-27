@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    {{ __('You are Admin') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Stok Kosong</h1>
    </div>

    <!-- Content Row -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Stok Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th style="padding-left: 1.7rem">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>
                                <button href="#" class="btn btn-success btn-circle btn-sm mr-1" data-toggle="modal" data-target="#editStok">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <!-- Modal Edit Kategori -->
                                <div class="modal fade text-left" id="editStok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Edit Stok</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="#">
                                                <div class="modal-body">
                                                    <label>Stok Barang</label>
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Kategori" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Simpan Kategori</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <a href="#" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
