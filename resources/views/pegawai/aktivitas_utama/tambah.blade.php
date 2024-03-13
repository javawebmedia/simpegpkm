<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Rencana Kinerja</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('pegawai/aktivitas-utama/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Nama Aktivitas</label>
          <div class="col-md-9">
            <select name="id_aktivitas" class="form-control select2" required>
              <option value="">Pilih Aktivitas</option>

              <?php 
              use App\Models\Aktivitas_utama_model;
              $m_aktivitas_utama  = new Aktivitas_utama_model();
              $nip                = Session()->get('nip');

              foreach($aktivitas as $aktivitas) { 
                $id_aktivitas   = $aktivitas->id_aktivitas;
                $check          = $m_aktivitas_utama->check_pegawai($nip,$id_aktivitas);
                if($check) {}else{
                  // klo sudah jadi aktivitas utama jangan tampilkan lagi
                ?>
                <option value="<?php echo $aktivitas->id_aktivitas ?>">
                  <?php echo $aktivitas->nama_aktivitas ?> - <?php echo $aktivitas->waktu ?> Menit
                </option>
              <?php }} ?>

            </select>
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