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
        <h1 class="h3 mb-0 text-gray-800">Edit Produk</h1>
        <div class="breadcrumb">
            <a href="{{ url('admin/merchandise/product/detail_product',$product->id) }}">
                <i class="fa-solid fa-arrow-left-long"></i>
            </a>
        </div>
    </div>

    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Produk</h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{ url('admin/merchandise/product/update',$product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" class="form-control" id="product_name" value="{{ $product->product_name }}" name="product_name" placeholder="Nama Produk">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="jumlah_produk">Jumlah Produk</label>
                            <input type="text" class="form-control" id="jumlah_produk" value="{{ $product->jumlah_product }}" name="jumlah_produk" placeholder="Jumlah Produk">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_description">Gambar Produk</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input @error('gambar_product') is-invalid @enderror" name="gambar_product" id="inputGroupFile01" accept=".jpg,.jpeg,.png" aria-describedby="inputGroupFileAddon01">
                          <label id="file_name" class="custom-file-label" for="inputGroupFile01">{{ $product->gambar_product }}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_description">Deskripsi Produk</label>
                    <textarea class="form-control" id="product_description" name="product_description" rows="3">{{ $product->deskripsi_product }}</textarea>
                </div>
                <div class="form-group">
                    <label for="harga_produk">Harga Produk</label>
                    <input type="text" class="form-control" id="harga_produk" value="{{ $product->harga }}" name="harga_produk" placeholder="Harga Produk">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori Produk</label>
                    <select class="form-control" name="kategori" id="kategori" aria-label="Default select example">
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $product->id_category ? 'selected' : '' }}>{{ $item->name_category }}</option>
                        @endforeach
                      </select>
                </div>
                <button type="submit" class="btn btn-primary float-right" id="tambah_produk">Simpan</button>
            </form>
        </div>
    </div>
    

</div>
<!-- /.container-fluid -->
@endsection

@section('cssstyle')
    <!-- Custom styles for this page -->
    <link href="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('title')
    Edit Produk
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    <script>

        $('#inputGroupFile01').on('change',function(e){
                //get the file name
                // var fileName = $(this).val().replace('C:\\fakepath\\', " ");
                var fileName = e.target.files[0].name;
                //replace the "Choose a file" label
                $(this).next('#file_name').html(fileName);
            })
    </script>
@endsection
