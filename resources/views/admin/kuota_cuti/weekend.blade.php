<form action="{{ asset('admin/kuota_cuti/proses-weekend') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
<script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","<?php echo asset('admin/kuota_cuti/tahunan') ?>?q="+str,true);
    xmlhttp.send();
  }
}
</script>
				<div class="form-group row">
					<label class="col-3">Nama Jenis &amp; Libur</label>
					<div class="col-4">
						<select name="id_pegawai" class="form-control select2">
							<?php foreach($pegawai as $pegawai) { ?>
							<option value="<?php echo $pegawai->id_pegawai ?>">
								<?php echo $pegawai->nama_pegawai ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-2">
						<select name="status_kuota_cuti" class="form-control">
							<option value="Publish">Publish</option>
							<option value="Draft">Draft</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tahun Libur Weekend</label>
					<div class="col-6">
						<select name="tahun" class="form-control"  onchange="showUser(this.value)" required>
							<option value="">Pilih Tahun</option>
							<?php 
					$mulai 	= date('Y');
					$akhir 	= date('Y')+10;
					for ($x = $akhir; $x >= $mulai; $x--) { 
					?>
							<option value="<?php echo $x ?>">Tahun <?php echo $x ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-3">Tanggal Libur Weekend</label>
					<div class="col-6">
						<div id="txtHint"><b></b></div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Keterangan</label>
					<div class="col-9">
						<textarea name="keterangan" class="form-control" placeholder="Keterangan"><?php echo old('keterangan') ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3"></label>
					<div class="col-9">
						
						<button type="submit" class="btn btn-success">Simpan&nbsp;<i class="fa fa-arrow-right"></i> </button>
					</div>
				</div>

</form>