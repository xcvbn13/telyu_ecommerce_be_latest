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
        <h1 class="h3 mb-0 text-gray-800">Tambah Merchandise</h1>
        <div class="breadcrumb">
            <a href="{{ url('admin/merchandise/product') }}">
                <i class="fa-solid fa-arrow-left-long"></i>
            </a>
        </div>
    </div>

    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Merchandise</h6>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/merchandise/product/store') }}" id="form_create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name') }}" placeholder="Nama Produk">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="jumlah_produk">Jumlah Produk</label>
                            <input type="text" class="form-control @error('jumlah_produk') is-invalid @enderror" id="jumlah_produk" name="jumlah_produk" value="{{ old('jumlah_produk') }}" placeholder="Jumlah Produk">
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
                          <label id="file_name" class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_description">Deskripsi Produk</label>
                    <textarea class="form-control @error('product_description') is-invalid @enderror" id="product_description" name="product_description" rows="3">{{ old('product_description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="harga_produk">Harga Produk</label>
                    <input type="text" class="form-control @error('harga_produk') is-invalid @enderror" id="harga_produk" name="harga_produk" value="{{ old('harga_produk') }}" placeholder="Harga Produk">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori Produk</label>
                    <select class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori" aria-label="Default select example">
                        <option selected>Pilih Kategori Produk</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name_category }}</option>
                        @endforeach
                      </select>
                </div>
                <button type="submit" class="btn btn-primary float-right" id="tambah_produk">Tambah</button>
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
