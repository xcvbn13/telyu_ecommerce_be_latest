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
        <h1 class="h3 mb-0 text-gray-800">Informasi Metode Pembayaran</h1>
        <!-- Button trigger modal -->
    </div>

    <!-- Content Row -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Metode Pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <th>No Rekening</th>
                            <th>Order</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($metodepembayaran as $item)
                            <tr>
                                <td>{{ $item->metode }}</td>
                                <td>{{ $item->no_rek }}</td>
                                <td>{{ $item->order->count() }}</td>
                                <td>
                                    <span class="
                                    @if ($item->id_status_metode == 1)
                                    badge badge-pill badge-success p-2
                                    @elseif ($item->id_status_metode == 2)
                                    badge badge-pill badge-danger p-2
                                    @endif
                                    ">{{ $item->status_metode->status }}</span>
                                </td>
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