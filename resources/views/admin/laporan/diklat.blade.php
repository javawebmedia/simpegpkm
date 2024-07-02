<form action="{{ asset('admin/laporan/diklat') }}" method="get" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Pilih Pegawai</label>
          <div class="col-md-9">
            <select name="nip" class="form-control select2" required>
              <option value="Semua">Semua pegawai</option>
              <?php foreach($pegawai as $pegawai) { ?>
                <option value="<?php echo $pegawai->nip ?>" <?php if(isset($_GET['nip']) && $_GET['nip']==$pegawai->nip) { echo 'selected'; } ?>>
                  <?php echo $pegawai->nama_lengkap ?> - NIP: <?php echo $pegawai->nip ?>
                </option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tahun Periode Diklat</label>
          <div class="col-md-9">
            <select name="tahun" class="form-control select2" required>
              <option value="">Tahun</option>
              <?php foreach($rekap_tahunan as $rekap_tahunan) { ?>
                <option value="<?php echo $rekap_tahunan->tahun ?>" <?php if(isset($_GET['tahun']) && $_GET['tahun']==$rekap_tahunan->tahun) { echo 'selected'; } ?>>
                  <?php echo $rekap_tahunan->tahun ?> (Ada <?php echo number_format($rekap_tahunan->total_diklat) ?> Diklat)
                </option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-save"></i> Buat Laporan
            </button>
          </div>
        </div>

        </form>

        <?php if(isset($_GET['nip'])) { ?>
<table class="table table-bordered table-sm" id="example1">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>NIP</th>
      <th>NIK</th>
      <th>Tahun</th>
      <th>Total JPL</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($diklat as $diklat) { ?>
    <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $diklat->nama_lengkap ?></td>
      <td><?php echo $diklat->nip ?></td>
      <td><?php echo $diklat->nik ?></td>
      <td><?php echo $tahun ?></td>
      <td><?php echo $diklat->total_jpl ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table>
        <?php } ?>