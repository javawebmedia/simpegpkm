@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('pegawai/dokumen/unggah') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
{{ csrf_field() }}

<input type="hidden" name="pengalihan" value="<?php echo url()->full(); ?>">
<input type="hidden" name="id_pegawai" value="<?php echo $pegawai->id_pegawai; ?>">

<div class="alert alert-secondary mb-3">
    Silakan Unggah Dokumen Anda di sini:
    <div class="input-group">
        <select name="id_jenis_dokumen" class="form-control" id="id_jenis_dokumen" required>
            <option value="">Pilih Jenis Dokumen</option>
            <?php foreach($jenis_dokumen2 as $jenis_dokumen2) { ?>
                <option value="<?php echo $jenis_dokumen2->id_jenis_dokumen ?>">
                    <?php echo $jenis_dokumen2->nama_jenis_dokumen ?>
                </option>
            <?php } ?>
        </select>
        <select name="id_sub_jenis_dokumen" class="form-control" id="id_sub_jenis_dokumen" required>
            <option value="">Pilih Sub Jenis Dokumen</option>
            <?php foreach($sub_jenis_dokumen as $sub_jenis_dokumen) { ?>
                <option value="<?php echo $sub_jenis_dokumen->id_sub_jenis_dokumen ?>" class="<?php echo $sub_jenis_dokumen->id_jenis_dokumen ?>">
                    <?php echo $sub_jenis_dokumen->nama_sub_jenis_dokumen ?>
                </option>
            <?php } ?>
        </select>
        <?php if(Session()->get('akses_level')=='Pegawai') { ?>
            <input type="hidden" name="status_dokumen_pegawai" value="Menunggu">
        <?php }else{ ?>
            <select name="status_dokumen_pegawai" class="form-control">
                <option value="Disetujui">Disetujui</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Ditolak">Ditolak</option>
                <option value="Diproses">Diproses</option>
            </select>
        <?php } ?>
        <input type="file" class="form-control" name="gambar" required>
          <span class="input-group-append">
            <button type="submit" class="btn btn-info btn-flat">Unggah <i class="fa fa-arrow-right"></i></button>
          </span>
    </div>

</div>
</form>

<script>
    $("#id_sub_jenis_dokumen").chained("#id_jenis_dokumen");
</script>

<table class="table table-sm tabelku">
<thead>
        <th width="10%">KODE</th>
        <th width="30%">NAMA JENIS DOKUMEN</th>
        <th width="20%">KETERANGAN</th>
        <th>TOTAL DOKUMEN</th>
        <th>LIHAT</th>
    </tr>
</thead>
<tbody>

    <?php $i = 1;
    foreach ($jenis_dokumen as $jenis_dokumen) {
        $sub_jenis_dokumen = $m_sub_jenis_dokumen->jenis_dokumen($jenis_dokumen->id_jenis_dokumen);
     ?>
     <tr>
        <td colspan="5" class="bg-light text-uppercase">
            <strong><?php echo $jenis_dokumen->nama_jenis_dokumen ?></strong>
        </td>
    </tr>

    <?php foreach($sub_jenis_dokumen as $sub_jenis_dokumen) {
        $id_jenis_dokumen       = $sub_jenis_dokumen->id_jenis_dokumen;
        $id_sub_jenis_dokumen   = $sub_jenis_dokumen->id_sub_jenis_dokumen;
        $dokumen_total          =  $m_dokumen_pegawai->total_all($id_pegawai,$id_jenis_dokumen,$id_sub_jenis_dokumen);
        $dokumen                =  $m_dokumen_pegawai->check_all($id_pegawai,$id_jenis_dokumen,$id_sub_jenis_dokumen);
     ?>
        <tr>
            <td><?php echo $sub_jenis_dokumen->kode_sub_jenis_dokumen ?></td>
            <td><?php echo $sub_jenis_dokumen->nama_sub_jenis_dokumen ?></td>
            <td><?php echo $sub_jenis_dokumen->keterangan ?></td>
            <td><?php echo $dokumen_total ?> Dokumen</td>
            <td>
                <?php if($dokumen_total >0) { ?>
                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#lihat_<?php echo $id_jenis_dokumen ?>_<?php echo $id_sub_jenis_dokumen ?>">
                        <i class="fa fa-eye"></i> Lihat
                    </button>
                    
                    @include('pegawai/dokumen/lihat')
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
        

    <?php $i++;
    } ?>

</tbody>
</table>