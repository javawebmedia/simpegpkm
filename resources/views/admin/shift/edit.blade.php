@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/shift/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_shift" value="{{ $shift->id_shift }}">

<div class="form-group row">
  <label class="col-md-3">Kode dan Warna Shift</label>
  <div class="col-md-3">
    <input type="text" name="kode" class="form-control" placeholder="Kode Shift" value="{{ $shift->kode }}" required>
  </div>

  <div class="col-md-5">
    <div class="input-group my-colorpicker2">
      <input type="text" name="warna" class="form-control" placeholder="Warna Shift" value="{{ $shift->warna }}" required>
      <div class="input-group-append">
        <span class="input-group-text"><i class="fas fa-square"></i></span>
      </div>
    </div>
  </div>

</div>

<div class="form-group row">
  <label class="col-md-3">Nama Shift</label>
  <div class="col-md-9">
    <input type="text" name="nama" class="form-control" placeholder="Nama shift" value="{{ $shift->nama }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Jam Mulai</label>
  <div class="col-md-9">
    <input type="text" name="jam_mulai" id="timepicker" class="form-control" placeholder="hh:mm:ss" value="<?php echo date('H:i:s',strtotime($shift->jam_mulai)) ?>" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Jam Selesai</label>
  <div class="col-md-9">
    <input type="text" name="jam_selesai" id="timepicker2" class="form-control" placeholder="hh:mm:ss" value="<?php echo date('H:i:s',strtotime($shift->jam_selesai)) ?>" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Hari</label>
  <div class="col-md-9">
    <!-- hari -->
    <?php 
    use Illuminate\Support\Facades\DB;
    $Senin  = DB::table('shift_hari')->where(['hari' => 'Senin','id_shift' => $shift->id_shift])->first();
    $Selasa = DB::table('shift_hari')->where(['hari' => 'Selasa','id_shift' => $shift->id_shift])->first();
    $Rabu   = DB::table('shift_hari')->where(['hari' => 'Rabu','id_shift' => $shift->id_shift])->first();
    $Kamis  = DB::table('shift_hari')->where(['hari' => 'Kamis','id_shift' => $shift->id_shift])->first();
    $Jumat  = DB::table('shift_hari')->where(['hari' => 'Jumat','id_shift' => $shift->id_shift])->first();
    $Sabtu  = DB::table('shift_hari')->where(['hari' => 'Sabtu','id_shift' => $shift->id_shift])->first();
    $Minggu = DB::table('shift_hari')->where(['hari' => 'Minggu','id_shift' => $shift->id_shift])->first();
    ?>
    <!-- end hari -->
    <!-- pilih hari -->
    <div class="form-group">

      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="Senin" name="hari[]" value="Senin" <?php if(!empty($Senin)) { echo 'checked'; } ?>>
        <label for="Senin" class="custom-control-label">Senin</label>
      </div>

      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="Selasa" name="hari[]" value="Selasa" <?php if(!empty($Selasa)) { echo 'checked'; } ?>>
        <label for="Selasa" class="custom-control-label">Selasa</label>
      </div>

      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="Rabu" name="hari[]" value="Rabu" <?php if(!empty($Rabu)) { echo 'checked'; } ?>>
        <label for="Rabu" class="custom-control-label">Rabu</label>
      </div>

      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="Kamis" name="hari[]" value="Kamis" <?php if(!empty($Kamis)) { echo 'checked'; } ?>>
        <label for="Kamis" class="custom-control-label">Kamis</label>
      </div>

      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="Jumat" name="hari[]" value="Jumat" <?php if(!empty($Jumat)) { echo 'checked'; } ?>>
        <label for="Jumat" class="custom-control-label">Jumat</label>
      </div>

      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="Sabtu" name="hari[]" value="Sabtu" <?php if(!empty($Sabtu)) { echo 'checked'; } ?>>
        <label for="Sabtu" class="custom-control-label">Sabtu</label>
      </div>

      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="Minggu" name="hari[]" value="Minggu" <?php if(!empty($Minggu)) { echo 'checked'; } ?>>
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
      <option value="Aktif" <?php if($shift->status=='Aktif') { echo 'selected'; } ?>>Aktif</option>
      <option value="Non Aktif" <?php if($shift->status=='Non Aktif') { echo 'selected'; } ?>>Non Aktif</option>
    </select>
    <small>Status shift</small>
  </div>

  <div class="col-md-2">
    <select name="ganti_hari" id="ganti_hari" class="form-control" required>
      <option value="Tidak" <?php if($shift->ganti_hari=='Tidak') { echo 'selected'; } ?>>Tidak</option>
      <option value="Ya" <?php if($shift->ganti_hari=='Ya') { echo 'selected'; } ?>>Ya</option>
    </select>
    <small>Lompat hari</small>
  </div>

  <div class="col-md-2">
    <select name="shift_default" id="shift_default" class="form-control" required>
      <option value="Tidak" <?php if($shift->shift_default=='Tidak') { echo 'selected'; } ?>>Tidak</option>
      <option value="Ya" <?php if($shift->shift_default=='Ya') { echo 'selected'; } ?>>Ya</option>
    </select>
    <small>Shif Default</small>
  </div>

  <div class="col-md-2">
    <select name="day_off" id="day_off" class="form-control" required>
      <option value="Tidak" <?php if($shift->day_off=='Tidak') { echo 'selected'; } ?>>Tidak</option>
      <option value="Ya" <?php if($shift->day_off=='Ya') { echo 'selected'; } ?>>Ya</option>
    </select>
    <small>Day off</small>
  </div>

  <div class="col-md-1">
    <select name="jumat" id="jumat" class="form-control" required>
      <option value="Tidak">Tidak</option>
      <option value="Ya"  <?php if($shift->jumat=='Ya') { echo 'selected'; } ?>>Ya</option>
    </select>
    <small>Jumat?</small>
  </div>

</div>

<div class="form-group row">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-9">
    <input type="text" name="keterangan" class="form-control" placeholder="keterangan" value="{{ $shift->keterangan }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/shift') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

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

