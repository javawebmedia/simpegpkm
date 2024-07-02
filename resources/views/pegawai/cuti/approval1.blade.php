


@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('pegawai/cuti/proses1') }}" method="post" accept-charset="utf-8">
      {{ csrf_field() }}
<div class="row mb-2">
  <div class="col-md-8">
    <div class="input-group">

          <select name="approval" class="form-control">
            <option value="Disetujui">Disetujui</option>
            <option value="Menunggu">Menunggu</option>
            <option value="Ditolak">Ditolak</option>
          </select>

      <textarea name="catatan" class="form-control" rows="1" placeholder="Catatan"></textarea>
      <span class="input-group-append">
        <button type="submit" name="submit" value="submit" class="btn btn-secondary">
          <i class="fa fa-save"></i> Update
        </button>
        

      </span>
    </div>
  </div>
  
</div>




<div class="mailbox-controls">
  <div class="table-responsive mailbox-messages">
<table class="table table-sm tabelku mt-3">
  <thead>
    <tr>
      <th width="5%" class="text-center">
        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
            </button>
      </th>
      <th>Jenis</th>
      <th>Tahun</th>
      <th>Tanggal Pengajuan</th>
      <th>Tanggal Cuti</th>
      <th>Total Hari</th>
      <th>Approval 1</th>
      <th>Approval 2</th>
      <th>Approval 3</th>
      <th>Status</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($cuti as $cuti) { ?>
    <tr>
      <td class="text-center">
        <div class="icheck-primary">
                    <input type="checkbox" value="<?php echo $cuti->id_cuti ?>" id="check<?php echo $cuti->id_cuti ?>" name="id_cuti[]">
                    <label for="check<?php echo $cuti->id_cuti ?>"></label>
                  </div>
      </td>
      <td><?php echo $cuti->nama_jenis_cuti ?></td>
      <td><?php echo $cuti->tahun ?></td>
      <td><?php echo $cuti->tanggal_pengajuan ?></td>
      <td>-</td>
      <td><?php echo $cuti->total_hari ?></td>
      <td>
        <?php if($cuti->approval_1=='Menunggu') { ?>
          <span class="badge badge-warning"><i class="fa fa-clock"></i> <?php echo $cuti->approval_1 ?></span>
        <?php }elseif($cuti->approval_1=='Ditolak') { ?>
          <span class="badge badge-dark"><i class="fa fa-times"></i> <?php echo $cuti->approval_1 ?></span>
        <?php }elseif($cuti->approval_1=='Disetujui') { ?>
          <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $cuti->approval_1 ?></span>
        <?php } ?>
        <?php if($cuti->approval_1=='Menunggu') {}else{ ?>
        <small class="text-secondary">
          <br>Tgl: <?php echo $cuti->tanggal_approval_1 ?>
          <br>Cat: <?php echo $cuti->catatan_1 ?>
        </small>
        <?php } ?>
      </td>
      <td>
        <?php if($cuti->approval_2=='Menunggu') { ?>
          <span class="badge badge-warning"><i class="fa fa-clock"></i> <?php echo $cuti->approval_2 ?></span>
        <?php }elseif($cuti->approval_2=='Ditolak') { ?>
          <span class="badge badge-dark"><i class="fa fa-times"></i> <?php echo $cuti->approval_2 ?></span>
        <?php }elseif($cuti->approval_2=='Disetujui') { ?>
          <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $cuti->approval_2 ?></span>
        <?php } ?>
        <?php if($cuti->approval_2=='Menunggu') {}else{ ?>
        <small class="text-secondary">
          <br>Tgl: <?php echo $cuti->tanggal_approval_2 ?>
          <br>Cat: <?php echo $cuti->catatan_2 ?>
        </small>
        <?php } ?>
      </td>
      <td>
        <?php if($cuti->approval_3=='Menunggu') { ?>
          <span class="badge badge-warning"><i class="fa fa-clock"></i> <?php echo $cuti->approval_3 ?></span>
        <?php }elseif($cuti->approval_3=='Ditolak') { ?>
          <span class="badge badge-dark"><i class="fa fa-times"></i> <?php echo $cuti->approval_3 ?></span>
        <?php }elseif($cuti->approval_3=='Disetujui') { ?>
          <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $cuti->approval_3 ?></span>
        <?php } ?>
        <?php if($cuti->approval_3=='Menunggu') {}else{ ?>
        <small class="text-secondary">
          <br>Tgl: <?php echo $cuti->tanggal_approval_3 ?>
          <br>Cat: <?php echo $cuti->catatan_3 ?>
        </small>
        <?php } ?>
      </td>
      <td>
        <?php if($cuti->status_cuti=='Menunggu') { ?>
          <span class="badge badge-warning"><i class="fa fa-clock"></i> <?php echo $cuti->status_cuti ?></span>
        <?php }elseif($cuti->status_cuti=='Ditolak') { ?>
          <span class="badge badge-dark"><i class="fa fa-times"></i> <?php echo $cuti->status_cuti ?></span>
        <?php }elseif($cuti->status_cuti=='Disetujui') { ?>
          <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $cuti->status_cuti ?></span>
        <?php } ?>
      </td>
      <td>
        
        <a href="{{ asset('pegawai/cuti/lihat/'.$cuti->kode_cuti) }}" class="btn btn-success btn-xs">
            <i class="fa fa-eye"></i>
          </a>
        <a href="{{ asset('pegawai/cuti/unduh/'.$cuti->kode_cuti) }}" class="btn btn-danger btn-xs" target="_blank">
            <i class="fa fa-file-pdf"></i>
          </a>
          
      </td>
    </tr>
    <?php $no++;} ?>
  </tbody>
</table>
</div>
</div>
