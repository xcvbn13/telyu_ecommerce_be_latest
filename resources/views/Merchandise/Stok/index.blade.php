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
        <h1 class="h3 mb-0 text-gray-800">Stok Produk Yang Kosong</h1>
    </div>

    <!-- Content Row -->

    <!-- Modal Edit Stok -->
    <div class="modal fade text-left" id="editStok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Stok</h4>
                    <button type="button" class="close" onclick="modalhide()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_update_stok">
                    @csrf
                    <input type="hidden" id="produk_id">
                    <div class="modal-body">
                        <label>Stok Barang</label>
                        <div class="form-group">
                            <input type="text" id="stok_product" name="stok_product" placeholder="0" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="simpan_stok" class="btn btn-primary" data-dismiss="modal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->jumlah_product }}</td>
                            <td style="padding-left:0.9rem ">
                                <button href="#" class="btn btn-success btn-circle btn-sm mr-1"  data-id="{{ $item->id }}" onclick="edit_stok($(this))">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
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

    {{-- sweetalert  --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

    <script>
        // edit kategori 

        function edit_stok(e) {
            let id = e.attr('data-id')
            var url = `{{ url('admin/merchandise/stok/edit', 'id') }}`;
            url = url.replace('id', id);

            $.ajax({
                type: "GET",
                url: url,
                success: function(results) {
                    console.log(results);
                    $('#editStok').modal('show')
                    $('#produk_id').val(results.id)
                }
            });
        }

        function modalhide(){
            $('#editStok').modal('hide');
        }

        $('#simpan_stok').click(function()  {
            let data = $("#form_update_stok").serialize()
            let id = $('#produk_id').val();

            let url = `{{ url('admin/merchandise/stok/tambah', 'id') }}`;
            url = url.replace('id', id);

            $.ajax({
                type: "PUT",
                url: url,
                data: data,
                success: function(results) {
                    console.log(results);
                    if (results === 'success') {
                        modalhide(),
                        Swal.fire(
                                'Success!',
                                'Stok Berhasil Ditambah',
                                'success'
                            ),
                            setTimeout(function() { // wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 1000);
                    }
                }
            });
        })
    </script>
@endsection
