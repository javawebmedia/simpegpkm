<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Absensi Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('admin/kehadiran/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Nama Pegawai</label>
          <div class="col-md-9">
            <select name="nip" id="nip" class="form-control select2bs4" required>
              <option value="">Pilih pegawai</option>
              @foreach($pegawai as $pegawai)
              <option value="{{ $pegawai->nip }}">{{ $pegawai->nama_lengkap . ' - ' . $pegawai->nip }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tahun dan Bulan</label>

          <div class="col-md-3">
            <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="{{ $tahun }}" required>
          </div>

          <div class="col-md-3">
            <select name="bulan" class="form-control" required>
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
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Jumlah Menit Terlambat</label>
          <div class="col-md-6">
            <input type="number" name="menit_terlambat" class="form-control" placeholder="Jumlah Menit Terlambat" value="{{ old('menit_terlambat') }}" required>
          </div>
          
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nilai pegawai</label>

          <div class="col-md-3">
            <input type="text" name="nilai_perilaku" class="form-control" placeholder="Nilai perilaku" value="{{ old('nilai_perilaku') }}" required>
            <small class="text-secondary">Nilai perilaku dari atasan</small>
          </div>

          <div class="col-md-3">
            <input type="text" name="nilai_serapan" class="form-control" placeholder="Nilai serapan" value="{{ old('nilai_serapan') }}" required>
            <small class="text-secondary">Nilai serapan (%)</small>
          </div>
          
        </div>

        <div class="form-group row">
          <label class="col-md-3">Info Ketidak Hadiran</label>

          <div class="col-md-3">
            <input type="number" name="sakit" class="form-control" placeholder="Jumlah sakit (hari)" value="{{ old('sakit') }}" required>
            <small class="text-secondary">Jumlah sakit (hari)</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="Jumlah sakit (hari)" class="form-control" placeholder="Jumlah izin (hari)" value="{{ old('Jumlah sakit (hari)') }}" required>
            <small class="text-secondary">Jumlah izin (hari)</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="alpa" class="form-control" placeholder="Jumlah alpa (hari)" value="{{ old('alpa') }}" required>
            <small class="text-secondary">Jumlah alpa (hari)</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>

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