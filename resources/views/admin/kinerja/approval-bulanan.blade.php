<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Setujui Kinerja Bulanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('admin/kinerja/setujui-bulanan') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="tanggal_kinerja" value="<?php echo $tanggal_kinerja ?>">

        <div class="form-group row">
          <label class="col-md-3">Tahun Bulan (THBL)</label>
          <div class="col-md-9">
            <select name="thbl" class="form-control select2" required>
              <option value="">Pilih Bulan dan Tahun</option>

              <?php foreach($menunggu as $menunggu) { ?>
                <option value="<?php echo $menunggu->thbl ?>">
                  <?php 
                  $tahun  = substr($menunggu->thbl,0,4);
                  $kodebl = substr($menunggu->thbl,4,6);
                  if($kodebl == '01') {
                    $bulan = 'Januari';
                  }elseif($kodebl == '02') {
                    $bulan = 'Februari';
                  }elseif($kodebl == '03') {
                    $bulan = 'Maret';
                  }elseif($kodebl == '04') {
                    $bulan = 'April';
                  }elseif($kodebl == '05') {
                    $bulan = 'Mei';
                  }elseif($kodebl == '06') {
                    $bulan = 'Juni';
                  }elseif($kodebl == '07') {
                    $bulan = 'Juli';
                  }elseif($kodebl == '08') {
                    $bulan = 'Agustus';
                  }elseif($kodebl == '09') {
                    $bulan = 'September';
                  }elseif($kodebl == '10') {
                    $bulan = 'Oktober';
                  }elseif($kodebl == '11') {
                    $bulan = 'November';
                  }elseif($kodebl == '12') {
                    $bulan = 'Desember';
                  }
                  echo $bulan.' '.$tahun;
                  ?>
                </option>
              <?php } ?>

            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan/Catatan</label>
          <div class="col-md-9">
            <textarea name="catatan_atasan" class="form-control">{{ old('catatan_atasan') }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Setujui Kinerja Bulanan</button>
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