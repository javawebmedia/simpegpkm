<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Mesin Absen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="25%">Lokasi</th>
              <th width="10%">Serial</th>
              <th width="10%">IP Address</th>
              <th width="10%">Key</th>
              <th width="10%">Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($mesin_absen as $mesin_absen) { ?>
            <tr>
              <td>{{ $no }}</td>
              <td>{{ $mesin_absen->lokasi }}</td>
              <td>{{ $mesin_absen->serial_number }}</td>
              <td>{{ $mesin_absen->ip_mesin_absen }}</td>
              <td>{{ $mesin_absen->key_mesin_absen }}</td>
              <td>{{ $mesin_absen->status_mesin_absen }}</td>
              <td>
                <a href="{{ asset('admin/data-finger/tarik/'.$mesin_absen->id_mesin_absen) }}" class="btn btn-success btn-xs mb-1"><i class="fa fa-sync"></i> Tarik Data Absensi</a>

              </td>
            </tr>
            <?php $no++; } ?>
          </tbody>
        </table>

      </div>
      <div class="modal-footer justify-content-between">
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->