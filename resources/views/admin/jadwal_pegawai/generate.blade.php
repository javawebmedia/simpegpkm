<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Generate Jadwal Kerja Pegawai Non Shift</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('admin/jadwal-pegawai/proses-generate') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="tahun" value="<?php echo $tahun ?>">
        <input type="hidden" name="bulan" value="<?php echo $bulan ?>">
        <input type="hidden" name="thbl" value="<?php echo $thbl ?>">
        <input type="hidden" name="status_shift" value="Tidak">

        <div class="form-group row">
          <label class="col-md-3">Periode Jadwal</label>
          <div class="col-md-9">
            <?php 
            if($bulan=='01') {
              echo 'Januari';
            }elseif($bulan=='02') {
              echo 'Februari';
            }elseif($bulan=='03') {
              echo 'Maret';
            }elseif($bulan=='04') {
              echo 'April';
            }elseif($bulan=='05') {
              echo 'Mei';
            }elseif($bulan=='06') {
              echo 'Juni';
            }elseif($bulan=='07') {
              echo 'Juli';
            }elseif($bulan=='08') {
              echo 'Agustus';
            }elseif($bulan=='09') {
              echo 'September';
            }elseif($bulan=='10') {
              echo 'Oktober';
            }elseif($bulan=='11') {
              echo 'November';
            }elseif($bulan=='12') {
              echo 'Desember';
            }
            ?>
            <?php echo $tahun ?>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Jumlah Pegawai</label>
          <div class="col-md-9">
            <?php echo $total_non_shift ?> Pegawai
          </div>
        </div>

        

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="generate" value="generate">
              Simpan dan Generate Jadwal Kerja <i class="fa fa-arrow-right"></i>
            </button>
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