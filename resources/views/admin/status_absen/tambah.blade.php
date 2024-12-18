<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('admin/status-absen/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

          <div class="form-group row">
            <label class="col-md-3">Kode Dan Warna Status Absen</label>
            <div class="col-md-3">
              <input type="text" name="kode_status_absen" class="form-control" placeholder="Kode Status Absen" value="{{ old('kode_status_absen') }}" >
            </div>
            <div class="col-md-5">
              <div class="input-group my-colorpicker2">
                <input type="text" name="warna_status_absen" class="form-control" placeholder="Warna Status Absen" value="{{ old('warna_status_absen') }}" >
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Nama Status Absen</label>
            <div class="col-md-9">
              <input type="text" name="nama_status_absen" class="form-control" placeholder="Nama status absen" value="{{ old('nama_status_absen') }}" >
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Jenis Absen</label>
            <div class="col-md-9">
              <select name="jenis_status_absen" id="jenis_status_absen" class="form-control" required>
                <option value="">Pilih Jenis</option>
                <option value="Absensi" >Absensi</option>
                <option value="Kehadiran" >Kehadiran</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Status Kehadiran</label>
            <div class="col-md-9">
              <select name="status_kehadiran" id="status_kehadiran" class="form-control" required>
                <option value="">Pilih Status Kehadiran</option>
                <option value="Hadir" >Hadir</option>
                <option value="Izin" >Izin</option>
                <option value="Sakit" >Sakit</option>
                <option value="Alpa" >Alpa</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Aktif ?</label>
            <div class="col-md-9">
              <select name="aktif_status_absen" id="aktif_status_absen" class="form-control" required>
                <option value="">Pilih Aktif</option>
                <option value="Aktif">Aktif</option>
                <option value="Non Aktif">Status Kehadiran</option>
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