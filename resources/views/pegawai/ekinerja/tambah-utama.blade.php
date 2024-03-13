 <input type="text" name="jam_mulai" class="form-control timepicker" placeholder="hh:mm" value="{{ old('jam_mulai') }}" required>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Input Aktivitas Utama</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('pegawai/ekinerja/input-ekinerja') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_pegawai" value="{{ Session()->get('id_pegawai') }}">
        <input type="hidden" name="jenis_aktivitas" value="Utama">

        <div class="form-group row">
          <label class="col-md-3">Pilih Aktivitas Utama</label>
          <div class="col-md-9">
            <select name="id_aktivitas_utama" class="form-control select2" required>
              <option value="">Pilih Aktivitas Utama</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tanggal &amp; Waktu Aktivitas</label>

          <div class="col-md-3">
            <input type="text" name="tanggal_kinerja" class="form-control datepicker" placeholder="dd-mm-yyyy" value="{{ old('tanggal_kinerja') }}" required>
            <small>Tanggal Aktivitas</small>
          </div>

          <div class="col-md-3">
            <input type="text" name="jam_mulai" class="form-control timepicker" placeholder="hh:mm" value="{{ old('jam_mulai') }}" required>
            <small>Jam Mulai</small>
          </div>

          <div class="col-md-3">
            <input type="text" name="jam_selesai" class="form-control" placeholder="hh:mm" value="{{ old('jam_selesai') }}" required>
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
</script>