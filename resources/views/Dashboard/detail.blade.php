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
        <h1 class="h3 text-gray-800">Detail Pesanan Customer</h1>
        <div class="breadcrumb">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-arrow-left-long"></i>
            </a>
        </div>
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
                                Customer
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order->name_user }}</div>
                            <div class="font-italic text-uppercase text-gray-800" style="font-size: 10pt">{{ $order->no_resi }}</div>
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
                                Status Pesanan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order->status_order }}</div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Harga Total
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div id="moneyFormat2" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">@money($order->jumlah_harga, 'IDR')</div>
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
        <div class="col-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alamat</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="mb-0 mr-3 font-weight-bold text-gray-800"> {{ $order->alamat }} </div>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Opsi Kirim</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="mb-0 mr-3 font-weight-bold text-gray-800"> {{ $order->opsikirim }} </div>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">No Telpon</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="mb-0 mr-3 font-weight-bold text-gray-800"> {{ $cart->user->no_telp }} </div>  
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
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($product as $item)
                        <tr>
                            <td> {{ $item->produk->product_name }} </td>
                            <td> @money($item->produk->harga, 'IDR')</td>
                            <td> {{ $item->jumlah_barang }} </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('title')
    Detail Pesanan
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
