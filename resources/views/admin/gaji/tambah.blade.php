<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Gaji Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('admin/gaji/tambah') }}" method="post" accept-charset="utf-8">
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
          <label class="col-md-3">TMT, Tahun dan Bulan</label>

          <div class="col-md-3">
            <input type="text" name="tmt" class="form-control datepicker" placeholder="TMT Gaji" value="{{ old('tmt') }}" required>
          </div>

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
          <label class="col-md-3">Gaji Pokok dan Pengali</label>
          <div class="col-md-3">
            <input type="number" name="gaji" class="form-control" placeholder="Gaji pokok" value="{{ old('gaji') }}" required>
            <small class="text-warning">Gaji pokok</small>
          </div>
          <div class="col-md-3">
            <input type="text" name="pengali" class="form-control" placeholder="Pengali" value="{{ old('pengali') }}" required>
            <small class="text-warning">Angka pengali TKD</small>
          </div>
           <div class="col-md-3">
            <input type="number" name="tkd" class="form-control" placeholder="Nilai TKD Flat" value="{{ old('tkd') }}" required>
            <small class="text-warning">Nilai TKD Flat</small>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tunjangan</label>
          <div class="col-md-3">
            <input type="number" name="tunjangan" class="form-control" placeholder="Tunjangan keluarga" value="{{ old('tunjangan') }}" required>
            <small class="text-warning">Tunjangan Keluarga</small>
          </div>
          <div class="col-md-3">
            <input type="number" name="tunjangan_jabatan" class="form-control" placeholder="Tunjangan jabatan" value="{{ old('tunjangan_jabatan') }}" required>
            <small class="text-warning">Tunjangan Keluarga</small>
          </div>
         
        </div>

        <div class="form-group row">
          <label class="col-md-3">Potongan</label>

          <div class="col-md-3">
            <input type="number" name="bpjs_kes" class="form-control" placeholder="Pot. BPJS Kesehatan" value="{{ old('bpjs_kes') }}" required>
            <small class="text-secondary">BPJS Kesehatan</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="bpjs_tk" class="form-control" placeholder="Pot. BPJS TK" value="{{ old('bpjs_tk') }}" required>
            <small class="text-secondary">BPJS TK</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="potongan_lainnya" class="form-control" placeholder="Pot. Lainnya" value="{{ old('potongan_lainnya') }}" required>
            <small class="text-secondary">Potongan Lainnya</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Besaran PPH21</label>

          <div class="col-md-3">
            <input type="number" name="pph_gaji" class="form-control" placeholder="PPH Gaji" value="{{ old('pph_gaji') }}" required>
            <small class="text-secondary">Besaran pajak gaji</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="pph_tkd" class="form-control" placeholder="PPH TKD" value="{{ old('pph_tkd') }}" required>
            <small class="text-secondary">Besaran pajak TKD</small>
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