<?php 
use App\Models\Aktivitas_utama_model;
$m_aktivitas_utama  = new Aktivitas_utama_model();
$nip                = Session()->get('nip');
 ?>

        <form action="{{ asset('pegawai/kinerja/proses-edit') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_pegawai" value="{{ Session()->get('id_pegawai') }}">
        <input type="hidden" name="jenis_aktivitas" value="{{ $kinerja->jenis_aktivitas }}">
        <input type="hidden" name="id_kinerja" value="{{ $kinerja->id_kinerja }}">

        <?php if($kinerja->jenis_aktivitas=='Umum') { ?>

        <div class="form-group row">
          <label class="col-md-3">Pilih Aktivitas Umum</label>
          <div class="col-md-9">
            <select name="id_aktivitas" class="form-control select2" required>
              <option value="">Pilih Aktivitas Utama</option>
               <?php 
              

              foreach($aktivitas as $aktivitas) { 
                $id_aktivitas   = $aktivitas->id_aktivitas;
                $check          = $m_aktivitas_utama->check_pegawai($nip,$id_aktivitas);
                if($check) {}else{
                  // klo sudah jadi aktivitas utama jangan tampilkan lagi
                ?>
                <option value="<?php echo $aktivitas->id_aktivitas ?>" <?php if($kinerja->id_aktivitas==$aktivitas->id_aktivitas) { echo 'selected'; } ?>>
                  <?php echo $aktivitas->nama_aktivitas ?> - <?php echo $aktivitas->waktu ?> Menit
                </option>
              <?php }} ?>
            </select>
          </div>
        </div>

      <?php }else{ ?>

        <div class="form-group row">
          <label class="col-md-3">Pilih Aktivitas Utama</label>
          <div class="col-md-9">
            <select name="id_aktivitas" class="form-control select2" required>
              <option value="">Pilih Aktivitas Utama</option>
               <?php 
              foreach($aktivitas_utama as $aktivitas_utama) { 
                ?>
                <option value="<?php echo $aktivitas_utama->id_aktivitas ?>"  <?php if($kinerja->id_aktivitas==$aktivitas_utama->id_aktivitas) { echo 'selected'; } ?>>
                  <?php echo $aktivitas_utama->nama_aktivitas ?> - <?php echo $aktivitas_utama->waktu ?> Menit
                </option>
              <?php } ?>
            </select>
          </div>
        </div>

      <?php } ?>

        <div class="form-group row">
          <label class="col-md-3">Tanggal &amp; Waktu Mulai</label>

          <div class="col-md-3">
            <input type="text" name="tanggal_kinerja" class="form-control datepicker" placeholder="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($kinerja->tanggal_kinerja)) }}" required>
            <small>Tanggal Mulai</small>
          </div>

          <div class="col-md-3">
            <input type="text" name="jam_mulai" class="form-control timepicker" placeholder="hh:mm" value="{{ $kinerja->jam_mulai }}" required>
            <small>Jam Mulai</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Tanggal &amp; Waktu Selesai</label>

          <div class="col-md-3">
            <input type="text" name="tanggal_selesai" class="form-control datepicker" placeholder="dd-mm-yyyy" value="<?php if(isset($_POST['tanggal_selesai'])) { echo old('tanggal_selesai'); }else{ echo date('d-m-Y',strtotime($kinerja->tanggal_selesai)); } ?>" required>
            <small>Tanggal Selesai</small>
          </div>

          <div class="col-md-3">
            <input type="text" name="jam_selesai" class="form-control timepicker2" placeholder="hh:mm" value="{{ $kinerja->jam_selesai }}" required>
            <small>Jam Selesai</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Catatan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ $kinerja->keterangan }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <a href="{{ asset('pegawai/kinerja?tanggal_kinerja='.date('d-m-Y',strtotime($kinerja->tanggal_kinerja))) }}" class="btn btn-default" data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>

        </form>

     

<script>
  $('.timepicker').timepicker({
    timeFormat: 'H:mm',
    interval: 15,
    defaultTime: '<?php echo date('H:i',strtotime($kinerja->jam_mulai)) ?>',
    dynamic: true,
    dropdown: true,
    scrollbar: true
  });

  $('.timepicker2').timepicker({
    timeFormat: 'H:mm',
    interval: 15,
    defaultTime: '<?php echo date('H:i',strtotime($kinerja->jam_selesai)) ?>',
    dynamic: true,
    dropdown: true,
    scrollbar: true
  });
</script>