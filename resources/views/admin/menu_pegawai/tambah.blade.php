<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('admin/menu-pegawai/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Pilih Pegawai yang Bisa Mengakses</label>
          <div class="col-md-9">
            <select name="id_pegawai" class="form-control select2" required>
            <option value="">Pilih pegawai</option>
            <?php foreach($pegawai as $pegawai) { ?>
              <option value="<?php echo $pegawai->id_pegawai ?>">
                <?php echo $pegawai->nama_lengkap ?> - NIP: <?php echo $pegawai->nip ?>
              </option>
            <?php } ?>
          </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nama Menu Pegawai</label>
          <div class="col-md-9">
            <input type="text" name="nama_menu" class="form-control" placeholder="Nama menu_pegawai" value="{{ old('nama_menu') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Icon Menu</label>
          <div class="col-md-9">
            <input type="text" name="icon" class="form-control" placeholder="Icon" value="{{ old('icon') }}" required>
            <small class="text-secondary">Icon menggunakan Fontawesome 6</small>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Link Menu</label>
          <div class="col-md-9">
            <div class="input-group">
                <span class="input-group-text">
                  {{ asset('/')}}
                </span>
                <input type="text" name="link" class="form-control" placeholder="Link" value="{{ old('link') }}" required>
            </div>
            <small class="text-secondary">Misal: <strong>admin/user</strong></small>
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