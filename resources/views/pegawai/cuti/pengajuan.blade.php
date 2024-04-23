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
    xmlhttp.open("GET","{{ asset('pegawai/cuti/tanggal') }}?q="+str,true);
    xmlhttp.send();
  }
}
</script>

<form action="{{ asset('pegawai/cuti/proses-pengajuan/'.$id_jenis_cuti.'/'.$total_hari) }}" method="post" accept-charset="utf-8">
      {{ csrf_field() }}

      <div class="form-group row">
        <label class="col-md-3">Jenis Cuti</label>
        <div class="col-md-9">
            <select name="id_jenis_cuti" class="form-control" required>

                <option value="">Pilih Jenis Cuti</option>
                <?php foreach($jenis_cuti as $jenis_cuti) { ?>
                <option value="<?php echo $jenis_cuti->id_jenis_cuti ?>" <?php if($id_jenis_cuti==$jenis_cuti->id_jenis_cuti) { echo 'selected'; } ?>>
                  <?php echo $jenis_cuti->nama_jenis_cuti ?>
                </option>}
                <?php } ?>

              </select>
      </div>
</div>

    <div class="form-group row">
        <label class="col-md-3">Total Pengajuan Hari Cuti</label>
        <div class="col-md-9">
            <select name="total_hari" class="form-control"  onchange="showUser(this.value)" required>

                <option value="">Pilih Total Hari</option>
                <?php 
                $i= 1; 
                do {
                ?>
                    <option value="<?php echo $i ?>" <?php if($i==$total_hari) { echo 'selected'; } ?>>
                        <?php echo $i ?> Hari
                    </option>
                <?php $i++; } while ($i <= $kuota_cuti->kuota); ?>

            </select>
      </div>
</div>
    
    <div class="form-group row">
        <label class="col-md-3">Tanggal Cuti</label>
        <div class="col-md-9">

            <div id="txtHint">
                <?php $no = 1; do{ ?>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Hari <?php echo $no ?></span>
                      </div>
                      <input type="text" class="form-control datepicker" name="tanggal_cuti[]" placeholder="dd-mm-yyyy" required>
                    </div>
                <?php $no++; }while($no <= $total_hari); ?>
            </div>

        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3">Alasan dan Keterangan</label>
        <div class="col-md-9">
            <textarea name="alasan_cuti" class="form-control">{{ old('alasan_cuti') }}</textarea>

        </div>
    </div>


      <div class="form-group row">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

      </div>
</form>



