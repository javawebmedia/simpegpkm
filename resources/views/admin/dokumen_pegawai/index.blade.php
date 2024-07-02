@if ($errors->any())


<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ asset('admin/dokumen-pegawai/proses') }}" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="<?php echo url()->full(); ?>">
<div class="input-group alert alert-light mb-2">
    <button class="btn btn-secondary" type="submit" name="hapus" onClick="check();">
        <i class="fa fa-trash"></i>
    </button>
    <select name="status_dokumen_pegawai" class="form-control">
        <option value="Disetujui">Disetujui</option>
        <option value="Menunggu">Menunggu</option>
        <option value="Ditolak">Ditolak</option>
        <option value="Diproses">Diproses</option>
    </select>
    <span class="input-group-append">
        <button type="submit" name="submit" value="submit" class="btn btn-info btn-flat">Update Status</button>
    </span>
</div>

<div class="mailbox-controls">
    <div class="table-responsive mailbox-messages">
    <table class="table table-sm tabelku" id="example1">
        <thead>
            
                <th width="5%">
                    <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                        </button>
                </th>
                <th width="15%">NAMA</th>
                <th width="10%">NIP</th>
                <th width="15%">JENIS DOKUMEN</th>
                <th>SUB JENIS DOKUMEN</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($dokumen_pegawai as $dokumen_pegawai) { ?>
                <td class="text-center">
                    <div class="icheck-primary">
                        <input type="checkbox" value="<?php echo $dokumen_pegawai->id_dokumen_pegawai ?>" id="check<?php echo $dokumen_pegawai->id_dokumen_pegawai ?>" name="id_dokumen_pegawai[]">
                        <label for="check<?php echo $dokumen_pegawai->id_dokumen_pegawai ?>"></label>
                    </div>
                </td>
                <td><a href="{{ asset('admin/dokumen-pegawai/pegawai/'.$dokumen_pegawai->id_pegawai) }}">
                        <?php echo $dokumen_pegawai->nama_lengkap ?>
                    </a>
                </td>
                <td><?php echo $dokumen_pegawai->nip ?></td>
                <td><?php echo $dokumen_pegawai->nama_jenis_dokumen ?></td>
                <td><?php echo $dokumen_pegawai->nama_sub_jenis_dokumen ?></td>
                <td>
                    <?php if($dokumen_pegawai->status_dokumen_pegawai=='Disetujui') { ?>
                        <span class="badge badge-success"><i class="fa fa-check-circle"></i> {{ $dokumen_pegawai->status_dokumen_pegawai }}</span>
                    <?php }elseif($dokumen_pegawai->status_dokumen_pegawai=='Menunggu') { ?>
                        <span class="badge badge-info"><i class="fa fa-clock"></i> {{ $dokumen_pegawai->status_dokumen_pegawai }}</span>
                    <?php }elseif($dokumen_pegawai->status_dokumen_pegawai=='Ditolak') { ?>
                        <span class="badge badge-secondary"><i class="fa fa-times-circle"></i> {{ $dokumen_pegawai->status_dokumen_pegawai }}</span>
                    <?php }elseif($dokumen_pegawai->status_dokumen_pegawai=='Diproses') { ?>
                        <span class="badge badge-primary"><i class="fa fa-running"></i> {{ $dokumen_pegawai->status_dokumen_pegawai }}</span>
                    <?php }else{ ?>
                        <span class="badge badge-secondary"><i class="fa fa-tasks"></i> {{ $dokumen_pegawai->status_dokumen_pegawai }}</span>
                    <?php } ?>
                </td>
                <td>
                    <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#detail" data-id="<?php echo $dokumen_pegawai->id_dokumen_pegawai ?>" data-file="<?php echo asset('assets/upload/file/'.$dokumen_pegawai->gambar) ?>">
                      <i class="fa fa-eye"></i>
                    </button>

                    <a href="{{ asset('admin/dokumen-pegawai/approval/'.$dokumen_pegawai->kode_dokumen_pegawai) }}" class="btn btn-secondary btn-xs approval-link">
                        <i class="fa fa-check-circle"></i></a>

                    <a href="{{ asset('assets/upload/file/'.$dokumen_pegawai->gambar) }}" class="btn btn-secondary btn-xs" title="Unduh" target="_blank"><i class="fa fa-download"></i> Unduh</a>
                    <a href="{{ asset('admin/dokumen-pegawai/delete/'.$dokumen_pegawai->kode_dokumen_pegawai) }}" class="btn btn-secondary btn-xs delete-link">
                        <i class="fa fa-trash"></i></a>
                </td>
                </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
</div>
</div>
</form>
<div class="modal fade" id="detail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Dokumen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

       <iframe id="dokumenIframe" src=""  height="300" style="width:100%;" allowfullscreen webkitallowfullscreen></iframe>

      </div>
      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#detail').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var file = button.data('file');
            var modal = $(this);
            var iframe = modal.find('#dokumenIframe');
            iframe.attr('src', file);
        });
    });
</script>