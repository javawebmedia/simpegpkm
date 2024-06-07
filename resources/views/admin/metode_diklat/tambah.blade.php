<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('admin/metode-diklat/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Jenis Metode Diklat</label>
          <div class="col-md-9">
            <select name="jenis_metode" class="form-control" required>
              <option value="">Pilih Jenis Metode</option>
              <option value="Klasikal">Klasikal</option>
              <option value="Non-Klasikal">Non-Klasikal</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nama Metode Diklat</label>
          <div class="col-md-9">
            <input type="text" name="nama_metode_diklat" class="form-control" placeholder="Nama metode_diklat" value="{{ old('nama_metode_diklat') }}" required>
          </div>
        </div>

        <div class="form-group row">
        <label class="col-md-3">Jumlah JP</label>
        <div class="col-md-9">
          <input type="number" name="jp" class="form-control" placeholder="Jumlah JP" value="{{ old('jp') }}">
        </div>
      </div>

      <div class="form-group row">
          <label class="col-md-3">No urut tampil</label>
          <div class="col-md-9">
            <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ old('urutan') }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
          </div>
        </div>

        

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>

        </form>

      </div>
      <div class="modal-footer justify-content-between">
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->