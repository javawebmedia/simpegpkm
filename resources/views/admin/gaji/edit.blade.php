

        <form action="{{ asset('admin/gaji/proses-edit') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_gaji" value="{{ $gaji->id_gaji }}">

        <div class="form-group row">
          <label class="col-md-3">Nama Pegawai</label>
          <div class="col-md-9">
            <select name="nip" id="nip" class="form-control select2bs4" required>
              <option value="">Pilih pegawai</option>
              @foreach($pegawai as $pegawai)
              <option value="{{ $pegawai->nip }}" <?php if($gaji->nip==$pegawai->nip) { echo 'selected'; } ?>>{{ $pegawai->nama_lengkap . ' - ' . $pegawai->nip }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">TMT, Tahun dan Bulan</label>

          <div class="col-md-3">
            <input type="text" name="tmt" class="form-control datepicker" placeholder="TMT Gaji" value="{{ date('d-m-Y',strtotime($gaji->tmt)) }}" required>
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
            <input type="number" name="gaji" class="form-control" placeholder="Gaji pokok" value="{{ $gaji->gaji }}" required>
            <small class="text-warning">Gaji pokok</small>
          </div>
          <div class="col-md-3">
            <input type="text" name="pengali" class="form-control" placeholder="Pengali" value="{{ $gaji->pengali }}" required>
            <small class="text-warning">Angka pengali TKD</small>
          </div>
          <div class="col-md-3">
            <input type="number" name="tkd" class="form-control" placeholder="Nilai TKD Flat" value="{{ $gaji->tkd }}" required>
            <small class="text-warning">Nilai TKD Flat</small>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tunjangan</label>
          <div class="col-md-3">
            <input type="number" name="tunjangan" class="form-control" placeholder="Tunjangan keluarga" value="{{ $gaji->tunjangan }}" required>
            <small class="text-warning">Tunjangan keluarga</small>
          </div>
          <div class="col-md-3">
            <input type="number" name="tunjangan_jabatan" class="form-control" placeholder="Tunjangan jabatan" value="{{ $gaji->tunjangan_jabatan }}" required>
            <small class="text-warning">Tunjangan jabatan</small>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Potongan</label>

          <div class="col-md-3">
            <input type="number" name="bpjs_kes" class="form-control" placeholder="Pot. BPJS Kesehatan" value="{{ $gaji->bpjs_kes }}" required>
            <small class="text-secondary">BPJS Kesehatan</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="bpjs_tk" class="form-control" placeholder="Pot. BPJS TK" value="{{ $gaji->bpjs_tk }}" required>
            <small class="text-secondary">BPJS TK</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="potongan_lainnya" class="form-control" placeholder="Pot. Lainnya" value="{{ $gaji->potongan_lainnya }}" required>
            <small class="text-secondary">Potongan Lainnya</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Besaran PPH21</label>

          <div class="col-md-3">
            <input type="number" name="pph_gaji" class="form-control" placeholder="Besaran PPH Gaji" value="{{ $gaji->pph_gaji }}" required>
            <small class="text-secondary">Besaran PPH Gaji</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="pph_tkd" class="form-control" placeholder="Besaran PPH TKD" value="{{ $gaji->pph_tkd }}" required>
            <small class="text-secondary">Besaran PPH TKD</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>

          <div class="col-md-9">
            <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ $gaji->keterangan }}</textarea>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <a href="<?php echo asset('admin/gaji?bulan='.$bulan.'&tahun='.$tahun) ?>" class="btn btn-secondary">
              <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>

        </form>

      