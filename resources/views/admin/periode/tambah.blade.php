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

        <form action="{{ asset('admin/periode/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Periode Gaji</label>
          <div class="col-md-9">
            <div class="input-group">
              <?php 
              $bulan= date('m'); 
              $tahun= date('Y');
              ?>
            <select name="bulan" class="form-control col-md-3 bg-light" required>
              <option value="">Pilih Bulan</option>
              <option value="01" <?php if($bulan=='01') { echo 'selected'; } ?>>Januari</option>
              <option value="02" <?php if($bulan=='02') { echo 'selected'; } ?>>Februari</option>
              <option value="03" <?php if($bulan=='03') { echo 'selected'; } ?>>Maret</option>
              <option value="04" <?php if($bulan=='04') { echo 'selected'; } ?>>April</option>
              <option value="05" <?php if($bulan=='05') { echo 'selected'; } ?>>Mei</option>
              <option value="06" <?php if($bulan=='06') { echo 'selected'; } ?>>Juni</option>
              <option value="07" <?php if($bulan=='07') { echo 'selected'; } ?>>Juli</option>
              <option value="08" <?php if($bulan=='08') { echo 'selected'; } ?>>Agustus</option>
              <option value="09" <?php if($bulan=='09') { echo 'selected'; } ?>>September</option>
              <option value="10" <?php if($bulan=='10') { echo 'selected'; } ?>>Oktober</option>
              <option value="11" <?php if($bulan=='11') { echo 'selected'; } ?>>November</option>
              <option value="12" <?php if($bulan=='12') { echo 'selected'; } ?>>Desember</option>
            </select>

            <input type="number" class="form-control" name="tahun" value="{{ $tahun }}" placeholder="Tahun">
          </div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Jumlah Hari</label>
          <div class="col-md-9">
            <input type="number" name="jumlah_hari" class="form-control" placeholder="Jumlah hari kerja efektif" value="{{ old('jumlah_hari') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>
          <div class="col-md-9">
            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value="{{ old('keterangan') }}">
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