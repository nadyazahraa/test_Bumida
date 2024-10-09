@extends('layouts.app')
@section('styles')
<style>
    .btn {
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    {{ __('Detail Purchase Order (PO)') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-warning" id="btn-tambah" data-toggle="modal" data-target="#addData" style="margin-bottom: 10px;">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                            <button type="button" class="btn btn-primary" id="btn-json" style="margin-bottom: 10px;">
                                Get Data
                            </button>
                        </div>
                        <div class="col-md-12">
                            <table id="tablePO" class="table table-striped table-hover table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <th>NAMA BARANG</th>
                                        <th>SATUAN</th>
                                        <th>JUMLAH</th>
                                        <th>HARGA SATUAN</th>
                                        <th>SUB TOTAL</th>
                                        <th>KETERANGAN</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div id="addData" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id='modalLabel' style="color: #0eb10c;">TAMBAH DATA HARGA</h5>
                <button type="button" id="close_modal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_add">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Isi nama barang">
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <select class="form-control select2" name="satuan" id="satuan" required>
                            <option value="">Pilih Satuan</option>
                            <option value="qty">Qty</option>
                            <option value="pcs">Pcs</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan (max. 50 karakter)</label>
                        <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="4" placeholder="Isi jika ada keterangan."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-submit" type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Simpan">
                    <i class="fa fa-save"></i>&nbsp;Submit
                </button>
                <button class="btn btn-danger" id="btn-cancel" data-dismiss="modal">CANCEL</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="addDetail_temp"></div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#tablePO").width("100%");
    });

    $('#btn-tambah').on('click', function() {
        $('#addData').modal('show');
    });

    var url_po = '{{ route("admin.buku-det") }}';
    var table_po = $('#tablePO').DataTable({
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        processing: true,
        "scrollX": true,
        "language": {
            'processing': '<div id="loading-screen" style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgba(102, 102, 102, 0.8); z-index: 30001;"><div id="loading-text" style="margin-top: 40vh !important;"><div style="padding-left: 7px;"><div class="loader"></div></div><span style="font-weight: 300;">Memproses...</span></div></div>'
        },
        searching: true,
        "aLengthMenu": [[5, 10, 25, 50, 75, 100], [5, 10, 25, 50, 75, 100]],
        "iDisplayLength": 25,
        ajax: {
            url: url_po,
            type: 'GET',
            dataType: 'json',
        },
        "serverSide": false,
        "deferRender": true,
        columns: [
            {data: null, name: null},
            {data: 'nama_barang', name: 'nama_barang', className: 'dt-center'},
            {data: 'satuan', name: 'submit_date', className: 'dt-center'},
            {data: 'jumlah', name: 'jumlah', className: 'dt-center'},
            {data: 'harga_satuan', name: 'harga_satuan', className: 'dt-center'},
            {data: 'sub_total', name: 'sub_total', className: 'dt-center'},
            {data: 'keterangan', name: 'keterangan', className: 'dt-center'}
            // {data: 'action', name: 'action', className: 'none', orderable: false, searchable: false}
        ]
    });

    $("#form_add").on("submit", function(e){
        e.preventDefault();
        var form = document.querySelector("#form_add");
        var formData = new FormData(form);
        console.log(formData);

        Swal.fire({
            title: 'Are you sure you want to submit?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit',
            cancelButtonText: 'Check Again',
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true,
            reverseButtons: false,
            focusCancel: false,
        }).then(function(result) {
            showLoading();
            $.ajax({
                url: "{{ route('admin.submit-buku') }}",
                type: 'post',
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                data: formData,
                dataType: 'json',
                success: function(_response) {
                    hideLoading();
                    if (_response.status == 1){
                        Swal.fire({
                            title: "Success",
                            text: _response.msg,
                            icon: "success",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(function(){
                            $(".modal").modal("hide");
                            table_po.ajax.reload();
                        });
                    } else {
                        Swal.fire("Info", _response.msg, "info");
                        hideLoading();
                    }
                },
                error: function(_response){
                    Swal.fire(
                        'Error Occurred',
                        'Please contact the admin!',
                        'error'
                    );
                    hideLoading();
                }
            });
        });
    });

    $("#btn-json").on("click", function(){
        $.ajax({
            url: '{{ route("admin.get-data") }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Error occurred:', error);
            }
        });
    });
</script>
@endsection
