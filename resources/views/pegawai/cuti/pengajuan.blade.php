<form action="{{ asset('pegawai/cuti/pengajuan/'.$id_jenis_cuti.'/'.$total_hari) }}" method="post" accept-charset="utf-8">
      {{ csrf_field() }}

      <div class="form-group row">
        <label class="col-md-3">Nama Agama</label>
        <div class="col-md-9">
            <select name="id_jenis_cuti" class="form-control" required>

                <option value="">Pilih Jenis Cuti</option>
                <?php foreach($jenis_cuti as $jenis_cuti) { ?>
                <option value="<?php echo $jenis_cuti->id_jenis_cuti ?>" <?php if($id_jenis_cuti==$jenis_cuti->id_jenis_cuti) { echo 'selected'; } ?>>
                  <?php echo $jenis_cuti->nama_jenis_cuti ?>
                </option>}
                <?php } ?>

              </select>
      </div>
</div>

      <div class="form-group row">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

      </div>
</form>