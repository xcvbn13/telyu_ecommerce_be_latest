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
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">15000 pcs</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-bag-shopping fa-2x text-gray-300"></i>
                            {{-- <i class="fa-solid fa-calender text-gray-300"></i> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Verifikasi Pembayaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">6969</div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fa-solid fa-list-radio fa-2x text-gray-300"></i> --}}
                            <i class="fa-solid fa-dollar-sign fa-2x text-gray-300"></i>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Terverifikasi
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">12312</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> --}}
                            <i class="fa-solid fa-list-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Selesai
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">12312</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> --}}
                            <i class="fa-solid fa-circle-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tanggal</th>
                            <th>Pesanan</th>
                            <th>Status</th>
                            <th style="padding-left: 1.7rem">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-circle btn-sm mr-1">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-circle btn-sm mr-1">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-circle btn-sm mr-1">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-circle btn-sm mr-1">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>Test test</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-circle btn-sm mr-1">
                                    <i class="fas fa-info-circle"></i>
                                </a>
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

@section('cssstyle')
    <!-- Custom styles for this page -->
    <link href="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endsection
