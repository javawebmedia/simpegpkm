<form action="{{ asset('admin/kehadiran/proses-rekap') }}" method="post" accept-charset="utf-8" class="mt-2">
  {{ csrf_field() }}

<input type="hidden" name="thbl" value="<?php echo $thbl ?>">
<input type="hidden" name="tahun" value="<?php echo $tahun ?>">
<input type="hidden" name="bulan" value="<?php echo $bulan ?>">
<input type="hidden" name="pin" value="<?php echo $pegawai->pin ?>">
<input type="hidden" name="nip" value="<?php echo $pegawai->nip ?>">
<input type="hidden" name="id_pegawai" value="<?php echo $pegawai->id_pegawai ?>">
<input type="hidden" name="id_kehadiran" value="<?php echo $kehadiran->id_kehadiran ?>">
<input type="hidden" name="pengalihan" value="<?php echo url()->full(); ?>">

<div class="modal fade" id="modal-update-<?php echo $kehadiran->id_kehadiran ?>">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Input Status Absensi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">

            <div class="form-group">
              <label>NIP pegawai</label>
              <input type="text" name="nip" class="form-control" value="<?php echo $pegawai->nip ?>" readonly>
            </div>
            
            <div class="form-group">
              <label>Nama pegawai</label>
              <input type="text" name="nama" class="form-control" value="<?php echo $pegawai->nama_lengkap ?>" readonly>
            </div>

            <div class="form-group">
              <label>Unit kerja</label>
              <textarea name="unit_kerja" class="form-control" readonly><?php echo $pegawai->nama_divisi ?></textarea>
            </div>

          </div>
      
       
        <div class="col-md-3">

            <div class="form-group row">
              <div class="col-md-6">
                <label>Tanggal awal</label>
                <input type="text" name="tanggal_masuk" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($kehadiran->tanggal_masuk)); ?>" readonly>
              </div>
              <div class="col-md-6">
                <label>Tanggal akhir</label>
                <input type="text" name="tanggal_keluar" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($kehadiran->tanggal_keluar)); ?>" readonly>
              </div>
            </div>

            <div class="form-group">
              <label>Status Kehadiran</label>
              <input type="text" name="nama_status_absen" class="form-control" id="nilai<?php echo $kehadiran->id_kehadiran ?>" value="<?php echo $kehadiran->nama_status_absen; ?>" readonly>
            </div>

            <div class="form-group">
              <label>Nomor Surat</label>
              <input type="text" name="nomor_surat" class="form-control" value="<?php echo $kehadiran->nomor_surat; ?>">
            </div>

            <div class="form-group">
              <label>Catatan Kehadiran/Absensi</label>
              <textarea name="catatan" class="form-control"><?php echo $kehadiran->catatan ?></textarea>
            </div>

          </div>

          <div class="col-md-6">
            <p>
              <i class="fa fa-clock"></i> Status Kehadiran
            </p>
            <hr>

            <div class="row mb-1">
            <?php foreach($hadir as $hadir) { ?>
              <div class="col-md-2">
                
                <button type="button" class="btn btn-xs w-100 mb-1 buttonku<?php echo $kehadiran->id_kehadiran ?>" value="<?php echo $hadir->nama_status_absen; ?>" style="background-color: <?php echo $hadir->warna_status_absen; ?>;">
                  <?php echo $hadir->kode_status_absen; ?>
                </button>
                

                
              </div>
            <?php } ?>
            </div>

            <p>
              <i class="fa fa-clock"></i> Status Absensi
            </p>
            <hr>
            <div class="row mb-1">
            <?php foreach($absen as $absen) { ?>
               <div class="col-md-2">
                <button type="button" class="btn btn-xs w-100 mb-1 buttonku<?php echo $kehadiran->id_kehadiran ?>" value="<?php echo $absen->nama_status_absen; ?>" style="background-color: <?php echo $absen->warna_status_absen; ?>;">
                    <?php echo $absen->kode_status_absen; ?>
                  </button>
                </div>
            <?php } ?>

            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan dan Lanjutkan <i class="fa fa-arrow-right"></i></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</form>

<script>
    let previouslyClickedButton<?php echo $kehadiran->id_kehadiran ?> = null;

    // Menambahkan event listener untuk semua elemen dengan class "buttonku"
    document.querySelectorAll('.buttonku<?php echo $kehadiran->id_kehadiran ?>').forEach(button => {
      button.addEventListener('click', function() {
        // Mengambil nilai dari tombol yang diklik
        const buttonValue = this.value;
        // Menempatkan nilai tersebut ke dalam input dengan id "nilai"
        document.getElementById('nilai<?php echo $kehadiran->id_kehadiran ?>').value = buttonValue;
        
        // Jika ada tombol sebelumnya yang diklik, aktifkan kembali tombol tersebut
        if (previouslyClickedButton<?php echo $kehadiran->id_kehadiran ?>) {
          previouslyClickedButton<?php echo $kehadiran->id_kehadiran ?>.disabled = false;
        }
        
        // Menonaktifkan tombol yang diklik
        this.disabled = true;
        
        // Simpan referensi tombol yang diklik
        previouslyClickedButton<?php echo $kehadiran->id_kehadiran ?> = this;
      });
    });
  </script>
