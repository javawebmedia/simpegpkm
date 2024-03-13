
<div class="modal fade" id="modal-umum">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Input Aktivitas Umum</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('pegawai/kinerja/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_pegawai" value="{{ Session()->get('id_pegawai') }}">
        <input type="hidden" name="jenis_aktivitas" value="Umum">

        <div class="form-group row">
          <label class="col-md-3">Pilih Aktivitas Umum</label>
          <div class="col-md-9">
            <select name="id_aktivitas" class="form-control select2" required>
              <option value="">Pilih Aktivitas Umum</option>
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
          <label class="col-md-3">Tanggal &amp; Waktu Mulai</label>

          <div class="col-md-3">
            <input type="text" name="tanggal_kinerja" class="form-control datepicker" placeholder="dd-mm-yyyy" value="{{ $tanggal }}" required>
            <small>Tanggal Mulai</small>
          </div>

          <div class="col-md-3">
            <input type="text" name="jam_mulai" class="form-control timepicker" placeholder="hh:mm" value="{{ old('jam_mulai') }}" required>
            <small>Jam Mulai</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Tanggal &amp; Waktu Selesai</label>

          <div class="col-md-3">
            <input type="text" name="tanggal_selesai" class="form-control datepicker" placeholder="dd-mm-yyyy" value="<?php if(isset($_POST['tanggal_selesai'])) { echo old('tanggal_selesai'); }else{ echo $tanggal; } ?>" required>
            <small>Tanggal Selesai</small>
          </div>

          <div class="col-md-3">
            <input type="text" name="jam_selesai" class="form-control timepicker2" placeholder="hh:mm" value="{{ old('jam_selesai') }}" required>
            <small>Jam Selesai</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Catatan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ old('keterangan') }}</textarea>
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

<script>
  $('.timepicker').timepicker({
    timeFormat: 'H:mm',
    interval: 15,
    defaultTime: '07:00',
    dynamic: true,
    dropdown: true,
    scrollbar: true
  });

  $('.timepicker2').timepicker({
    timeFormat: 'H:mm',
    interval: 15,
    defaultTime: '07:30',
    dynamic: true,
    dropdown: true,
    scrollbar: true
  });
</script>