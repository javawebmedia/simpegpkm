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

        <form action="{{ asset('admin/mesin-absen/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">IP Mesin Absen</label>
          <div class="col-md-9">
            <input type="text" name="ip_mesin_absen" class="form-control" placeholder="IP Mesin Absen" value="{{ old('ip_mesin_absen') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Key Mesin Absen</label>
          <div class="col-md-9">
            <input type="text" name="key_mesin_absen" class="form-control" placeholder="Key Mesin Absen" value="{{ old('key_mesin_absen') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Serial Number Mesin Absen</label>
          <div class="col-md-9">
            <input type="text" name="serial_number" class="form-control" placeholder="Serial Number Mesin Absen" value="{{ old('serial_number') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Lokasi Mesin Absen</label>
          <div class="col-md-9">
            <input type="text" name="lokasi" class="form-control" placeholder="Lokasi Mesin Absen" value="{{ old('lokasi') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Status Mesin Absen</label>
          <div class="col-md-9">
            <select name="status_mesin_absen" class="form-control">
              <option value="Aktif">Aktif</option>
              <option value="Non Aktif">Non Aktif</option>
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