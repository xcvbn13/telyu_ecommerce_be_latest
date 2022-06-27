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
        <h1 class="h3 mb-0 text-gray-800">Kategori Merchandise</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-block col-2" data-toggle="modal" data-target="#tambah_kategori">
            Tambah Kategori
        </button>
    </div>

    <!-- Content Row -->

    <!-- Modal -->
    <div class="modal fade text-left" id="tambah_kategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Input Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formtambahkategori">
                    @csrf
                    <div class="modal-body">
                        <label>Kategori</label>
                        <div class="form-group">
                            <input type="text" name="kategori" id="kategori" placeholder="Kategori" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="kategori_tambah" class="btn btn-primary" data-dismiss="modal">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div class="modal fade text-left" id="editKategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="modalhide()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit_kategori">
                    @csrf
                    <input type="hidden" id="kategori_id">
                    <div class="modal-body">
                        <label>Kategori</label>
                        <div class="form-group">
                            <input type="text" id="edit_kategori" name="kategori" placeholder="Kategori" class="form-control" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="kategori_simpan" class="btn btn-primary" data-dismiss="modal">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kategori Merchandise</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kategori Produk</th>
                            <th>Jumlah Produk</th>
                            <th style="padding-left: 1.7rem">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $item)
                            <tr>
                                <td>{{ $item->name_category }}</td>
                                <td>{{ $item->products->count() }}</td>
                                <td>
                                    <button href="#" class="btn btn-success btn-circle btn-sm mr-1" data-id="{{ $item->id }}" onclick="edit_kategori($(this))">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button href="#" class="btn btn-danger btn-circle btn-sm" data-id="{{ $item->id }}" onclick="delete_kategori($(this))">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
    Kategori Produk
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

        // Get the input field
        var input = document.getElementById("tambah_kategori");

        // Execute a function when the user presses a key on the keyboard
        input.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("kategori_tambah").click();
        }
        });
        
        // tambah kategori 
        $('#kategori_tambah').click(function() {
            let data = $("#formtambahkategori").serialize()
            console.log(data)

            var url = "{{ url('admin/merchandise/kategori/create') }}";
            console.log(url)

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(results) {
                    console.log(results)
                    if (results === 'success') {
                        Swal.fire(
                                'Success!',
                                'Kategori Ditambahkan',
                                'success'
                            ),
                            setTimeout(function() { // wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 1000);
                    }
                }
            });
        })

        // edit kategori 
        function edit_kategori(e) {
            let id = e.attr('data-id')
            var url = `{{ url('admin/merchandise/kategori/edit', 'id') }}`;
            url = url.replace('id', id);

            $.ajax({
                type: "GET",
                url: url,
                success: function(results) {
                    console.log(results)
                    $('#editKategori').modal('show')
                    $('#kategori_id').val(results.id)
                    $('#edit_kategori').val(results.name_category)
                }
            });
        }

        function modalhide(){
            $('#editKategori').modal('hide');
        }

        $('#kategori_simpan').click(function() {
            let data = $("#form_edit_kategori").serialize()
            let id = $('#kategori_id').val();

            let url = `{{ url('admin/merchandise/kategori/update', 'id') }}`;
            url = url.replace('id', id);

            $.ajax({
                type: "PUT",
                url: url,
                data: data,
                success: function(results) {
                    console.log(results);
                    if (results === 'success') {
                        Swal.fire(
                                'Success!',
                                'Kategori Berhasil Diubah',
                                'success'
                            ),
                            setTimeout(function() { // wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 1000);
                    }
                }
            });
        })

        // delete kategori 

        function delete_kategori(e) {
            let id = e.attr('data-id')
            var url = `{{ url('admin/merchandise/kategori/delete', 'id') }}`;
            url = url.replace('id', id);
            var token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: 'Apa Kamu Yakin?',
                text: "Kamu tidak bisa mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            "_token": token
                        },
                        success: function(results) {
                            console.log(results);
                            if (results === 'success') {
                                Swal.fire(
                                        'Berhasil!',
                                        'Data Berhasil Dihapus.',
                                        'success'
                                    ),
                                    setTimeout(function() { // wait for 5 secs(2)
                                        location.reload(); // then reload the page.(3)
                                    }, 1000);
                            }else{
                                Swal.fire(
                                        'Gagal!',
                                        'Ada Produk Yang Menggunakan Kategori Ini.',
                                        'warning'
                                    )
                            }
                        }
                    });

                }
            })
        }
    </script>
@endsection