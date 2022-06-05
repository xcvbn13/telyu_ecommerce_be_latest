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
        <h1 class="h3 mb-0 text-gray-800">Detail Product</h1>
        <a href="{{ url('admin/merchandise/product/edit',$product->id) }}" class="btn btn-primary btn-block col-2">Edit Produk</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Nama Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $product->product_name }}</div>
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
        <div class="col">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Stok Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $product->jumlah_product }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-boxes-stacked fa-2x text-gray-300"></i>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Harga Produk
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $product->harga }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-rupiah-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->
    <!-- Content Row -->
    <div class="row mt-4">
        <!-- Donut Chart -->
        <div class="col-xl-7 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Deskripsi Produk</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="mb-0 mr-3 font-weight-bold text-gray-800">{{ $product->deskripsi_product }}</div>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="col col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kategori Produk</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="mb-0 mr-3 font-weight-bold text-gray-800">{{ $product->category->name_category }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-end flex-column mb-4">
        <div class="breadcrumb">
            <a href="{{ url('admin/merchandise/product') }}">
                <i class="fa-solid fa-arrow-left-long"></i>  Kembali
            </a>
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
