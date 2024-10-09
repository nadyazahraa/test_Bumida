<div id="addData" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg"> <!-- Menambahkan kelas modal-lg untuk ukuran lebih besar -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id='modalLabel'TAMBAH DATA HARGA</h5>
                <button type="button" id="close_modal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_add" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Isi nama barang">
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <select class="form-control select2" name="satuan" id="satuan" required>
                            <option value="">Pilih Satuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" value="0" min="0">
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
                <button id="btn-submit" type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Simpan">
                    <i class="fa fa-save"></i>&nbsp;Submit
                </button>
                <button class="btn btn-danger" id="btn-cancel" data-dismiss="modal">CANCEL</button>
            </div>
        </div>
    </div>
</div>
