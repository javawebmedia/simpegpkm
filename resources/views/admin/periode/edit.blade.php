@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/periode/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_periode" value="{{ $periode->id_periode }}">

<div class="form-group row">
          <label class="col-md-3">Periode Gaji</label>
          <div class="col-md-9">
            <div class="input-group">
              <?php 
              $bulan= $periode->bulan; 
              $tahun= $periode->tahun;
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
            <input type="number" name="jumlah_hari" class="form-control" placeholder="Jumlah hari kerja efektif" value="{{ $periode->jumlah_hari }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>
          <div class="col-md-9">
            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value="{{ $periode->keterangan }}">
          </div>
        </div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/periode') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

