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

        <form action="{{ asset('admin/kode-diklat/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Status Diklat</label>
          <div class="col-md-9">
            <select name="status_aktif" class="form-control select2" required>
              <option value="Aktif">Aktif</option>
              <option value="Non Aktif">Non Aktif</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Rumpun</label>
          <div class="col-md-9">
            <select name="id_rumpun" class="form-control" id="id_rumpun" required>
              <option value="">Pilih Rumpun</option>
              <?php foreach($rumpun as $rumpun) { ?>
              <option value="<?php echo $rumpun->id_rumpun ?>">
                <?php echo $rumpun->nama_rumpun ?>
              </option>
            <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Jenis Pelatihan</label>
          <div class="col-md-9">
            <select name="id_jenis_pelatihan" class="form-control" id="id_jenis_pelatihan" required>
              <option value="">Pilih Jenis Pelatihan</option>
              <?php foreach($jenis_pelatihan as $jenis_pelatihan) { ?>
              <option value="<?php echo $jenis_pelatihan->id_jenis_pelatihan ?>"  class="{{ $jenis_pelatihan->id_rumpun }}">
                <?php echo $jenis_pelatihan->nama_jenis_pelatihan ?>
              </option>
            <?php } ?>
            </select>
          </div>
        </div>

        <script>
            $("#id_jenis_pelatihan").chained("#id_rumpun");
          </script>

        <div class="form-group row">
          <label class="col-md-3">Kode Diklat</label>
          <div class="col-md-9">
            <input type="number" name="kode_diklat" class="form-control" placeholder="Kode diklat" value="{{ old('kode_diklat') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nama Diklat</label>
          <div class="col-md-9">
            <input type="text" name="nama_kode_diklat" class="form-control" placeholder="Nama Diklat" value="{{ old('nama_kode_diklat') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">No urut tampil</label>
          <div class="col-md-9">
            <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ old('urutan') }}" required>
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