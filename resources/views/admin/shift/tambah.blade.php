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

        <form action="{{ asset('admin/shift/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

          <div class="form-group row">
            <label class="col-md-3">Kode dan Warna Shift</label>

            <div class="col-md-3">
              <input type="text" name="kode" class="form-control" placeholder="Kode Shift" value="{{ old('kode') }}" required>
            </div>

            <div class="col-md-5">
              <div class="input-group my-colorpicker2">
                <input type="text" name="warna" class="form-control" placeholder="Warna Shift" value="{{ old('warna') }}" required>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
              </div>
            </div>

          </div>

          <div class="form-group row">
            <label class="col-md-3">Nama Shift</label>
            <div class="col-md-9">
              <input type="text" name="nama" class="form-control" placeholder="Nama shift" value="{{ old('nama') }}" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Jam Mulai</label>
            <div class="col-md-3">
              <input type="text" name="start_jam_mulai" id="timepicker" class="form-control" placeholder="Start Jam Mulai" value="{{ old('start_jam_mulai') }}" required>
            </div>
            <div class="col-md-3">
              <input type="text" name="jam_mulai" id="timepicker2" class="form-control" placeholder="Jam Mulai" value="{{ old('jam_mulai') }}" required>
            </div>
            <div class="col-md-3">
              <input type="text" name="end_jam_mulai" id="timepicker3" class="form-control" placeholder="End Jam Mulai" value="{{ old('end_jam_mulai') }}" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Jam Selesai</label>
            <div class="col-md-3">
              <input type="text" name="start_jam_selesai" id="timepicker4" class="form-control" placeholder="Start Jam Selesai" value="{{ old('start_jam_selesai') }}" required>
            </div>
            <div class="col-md-3">
              <input type="text" name="jam_selesai" id="timepicker5" class="form-control" placeholder="Jam Selesai" value="{{ old('jam_selesai') }}" required>
            </div>
            <div class="col-md-3">
              <input type="text" name="end_jam_selesai" id="timepicker6" class="form-control" placeholder="End Jam Selesai" value="{{ old('end_jam_selesai') }}" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Hari</label>
            <div class="col-md-9">
              <!-- pilih hari -->
              <div class="form-group" style="display: flex; flex-wrap: wrap;">

                <div class="custom-control custom-checkbox mr-3">
                  <input class="custom-control-input" type="checkbox" id="Senin" name="hari[]" value="Senin">
                  <label for="Senin" class="custom-control-label">Senin</label>
                </div>

                <div class="custom-control custom-checkbox mr-3">
                  <input class="custom-control-input" type="checkbox" id="Selasa" name="hari[]" value="Selasa">
                  <label for="Selasa" class="custom-control-label">Selasa</label>
                </div>

                <div class="custom-control custom-checkbox mr-3">
                  <input class="custom-control-input" type="checkbox" id="Rabu" name="hari[]" value="Rabu">
                  <label for="Rabu" class="custom-control-label">Rabu</label>
                </div>

                <div class="custom-control custom-checkbox mr-3">
                  <input class="custom-control-input" type="checkbox" id="Kamis" name="hari[]" value="Kamis">
                  <label for="Kamis" class="custom-control-label">Kamis</label>
                </div>

                <div class="custom-control custom-checkbox mr-3">
                  <input class="custom-control-input" type="checkbox" id="Jumat" name="hari[]" value="Jumat">
                  <label for="Jumat" class="custom-control-label">Jumat</label>
                </div>

                <div class="custom-control custom-checkbox mr-3">
                  <input class="custom-control-input" type="checkbox" id="Sabtu" name="hari[]" value="Sabtu">
                  <label for="Sabtu" class="custom-control-label">Sabtu</label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="Minggu" name="hari[]" value="Minggu">
                  <label for="Minggu" class="custom-control-label">Minggu</label>
                </div>

              </div>
              <!-- end pilih hari -->
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Status Shift dan Ganti Hari</label>

            <div class="col-md-2">
              <select name="status" id="status" class="form-control" required>
                <option value="">Pilih status Shift</option>
                <option value="Aktif">Aktif</option>
                <option value="Non Aktif">Non Aktif</option>
              </select>
              <small>Status shift</small>
            </div>

            <div class="col-md-2">
              <select name="ganti_hari" id="ganti_hari" class="form-control" required>
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
              </select>
              <small>Lompat hari</small>
            </div>

            <div class="col-md-2">
              <select name="shift_default" id="shift_default" class="form-control" required>
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
              </select>
              <small>Shift default</small>
            </div>

            <div class="col-md-2">
              <select name="day_off" id="day_off" class="form-control" required>
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
              </select>
              <small>Day off</small>
            </div>

            <div class="col-md-1">
              <select name="jumat" id="jumat" class="form-control" required>
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
              </select>
              <small>Jumat?</small>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Keterangan</label>
            <div class="col-md-9">
              <input type="text" name="keterangan" class="form-control" placeholder="keterangan" value="{{ old('keterangan') }}">
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
    theme: 'red',

    // custom label text
    okLabel: 'Done',
    cancelLabel: 'Cancle',

    });
</script>

<script>
  $('#timepicker3').mdtimepicker({

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
  $('#timepicker4').mdtimepicker({

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

<script>
  $('#timepicker5').mdtimepicker({

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

<script>
  $('#timepicker6').mdtimepicker({

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