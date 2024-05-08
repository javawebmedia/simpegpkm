<form action="{{ asset('admin/data-finger/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

<div class="modal fade" id="modal-input">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Input Data Finger Masuk dan Pulang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-info"><i class="fa fa-user"></i> Pilih Pegawai</div>
              <div class="card-body">
                <div class="form-group">
                  <label>Pilih Pegawai</label>
                  <select name="pin" class="form-control select2" required>
                    <option value="">Pilih Pegawai</option>
                    <?php foreach($pegawai as $pegawai) { ?>
                      <option value="<?php echo $pegawai->pin ?>">
                        <?php echo $pegawai->nama_lengkap ?> (NIP: <?php echo $pegawai->nip ?>)
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-secondary"><i class="fa fa-calendar-check"></i> Input Data Masuk</div>
              <div class="card-body">

                <div class="form-group">
                  <label>Pilih mesin absen</label>
                  <select name="id_mesin_absen" class="form-control select2" required>
                    <option value="">Pilih Mesin Absen Masuk</option>
                    <?php foreach($mesin_absen2 as $mesin_absen2) { ?>
                      <option value="<?php echo $mesin_absen2->id_mesin_absen ?>">
                        <?php echo $mesin_absen2->lokasi ?> (<?php echo $mesin_absen2->ip_mesin_absen ?>)
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Tanggal dan jam masuk</label>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="tanggal_finger" class="form-control datepicker" value="{{ old('tanggal_finger') }}" readonly required>
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="jam_finger" class="form-control" id="timepicker" value="{{ old('jam_finger') }}" required>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-warning"><i class="fa fa-calendar-times"></i> Input Data Pulang</div>
              <div class="card-body">
                
                <div class="form-group">
                  <label>Pilih mesin absen</label>
                  <select name="id_mesin_absen_pulang" class="form-control select2" required>
                    <option value="">Pilih Mesin Absen Pulang</option>
                    <?php foreach($mesin_absen3 as $mesin_absen3) { ?>
                      <option value="<?php echo $mesin_absen3->id_mesin_absen ?>">
                        <?php echo $mesin_absen3->lokasi ?> (<?php echo $mesin_absen3->ip_mesin_absen ?>)
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Tanggal dan jam Pulang</label>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="tanggal_finger_pulang" class="form-control datepicker" value="{{ old('tanggal_finger') }}" readonly required>
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="jam_finger_pulang" class="form-control" id="timepicker2" value="{{ old('jam_finger') }}" required>
                    </div>
                  </div>
                </div>

              </div>
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
  $('#timepicker').mdtimepicker({

    // time format
    timeFormat: 'hh:mm:ss.000', 

    // format of the input value
    format: 'hh:mm tt',

    // readonly mode
    readOnly: false, 

    // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
    hourPadding: false,

    // theme of the timepicker
    // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
    theme: 'red',

    // custom label text
    okLabel: 'Done',
    cancelLabel: 'Cancle',

    });
</script>

<script>
  $('#timepicker2').mdtimepicker({

    // time format
    timeFormat: 'hh:mm:ss.000', 

    // format of the input value
    format: 'hh:mm tt',

    // readonly mode
    readOnly: false, 

    // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
    hourPadding: false,

    // theme of the timepicker
    // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
    theme: 'green',

    // custom label text
    okLabel: 'Done',
    cancelLabel: 'Cancle',

    });
</script>