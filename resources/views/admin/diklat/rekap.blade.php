<table class="table table-bordered table-sm" id="example1">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>NIP</th>
      <th>NIK</th>
      <th>Kode & Nama Diklat</th>
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
      <td><?php echo $diklat->kode_diklat ?><small><br>Nama Diklat : <?php echo $diklat->nama_diklat ?></small></td>
      <td><?php echo $tahun ?></td>
      <td><?php echo $diklat->total_jpl ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table>