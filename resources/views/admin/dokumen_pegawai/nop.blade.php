@if ($errors->any())

<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<table class="tabelku table-sm">
    <thead>
        <tr>
            <th width="25%">Nomor objek pegawai</th>
            <th><?php if($pegawai) { echo $pegawai->nomor_objek_pegawai; }else{ echo '-'; } ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Pemilik</td>
            <td><?php if($pegawai) { echo $pegawai->nama_pemilik; }else{ echo '-'; } ?></td>
        </tr>
        <tr>
            <td>NPWP</td>
            <td><?php if($pegawai) { echo $pegawai->npwp_pemilik; }else{ echo '-'; } ?></td>
        </tr>
    </tbody>
</table>

<p>
    @include('admin/dokumen_pegawai/tambah')
</p>
<form action="{{ asset('admin/dokumen_pegawai/proses') }}" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="row pb-2">
        <div class="col-md-12">
            <button class="btn btn-dark" type="submit" name="hapus" onClick="check();">
                <i class="fa fa-trash"></i>
            </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus-circle"></i> Tambah Baru
            </button>
            <a href="{{ asset('admin/dokumen-pegawai/unggah') }}" class="btn btn-info">
                <i class="fa fa-tasks"></i> Unggah Banyak Dokumen
            </a>
            <a href="{{ asset('admin/dokumen-pegawai') }}" class="btn btn-outline-info">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <table class="tabelnya table-sm" id="example1">
        <thead>
            
                <th width="5%">NO</th>
                <th width="15%">NOP</th>
                <th width="15%">PEMILIK</th>
                <th width="10%">JENIS</th>
                <th width="15%">KETERANGAN</th>
                <th width="10%">TANGGAL</th>
                <th>NOMOR</th>
                <!-- <th>STATUS</th> -->
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
            foreach ($dokumen_pegawai as $dokumen_pegawai) { ?>

                <td class="text-center">
                    <input class="form-check-input" type="checkbox" name="id_dokumen_pegawai[]" value="<?php echo $dokumen_pegawai->id_dokumen_pegawai ?>" id="gridCheck<?php echo $i ?>">
                </td>
                <td><a href="{{ asset('admin/dokumen-pegawai/nop/'.$dokumen_pegawai->nomor_objek_pegawai) }}">
                        <?php echo $dokumen_pegawai->nomor_objek_pegawai ?>
                    </a>
                </td>
                <td><?php echo $dokumen_pegawai->nama_pemilik ?></td>
                <td><?php echo $dokumen_pegawai->kode_jenis_dokumen ?></td>
                <td><?php echo $dokumen_pegawai->keterangan ?></td>
                <td><?php echo $dokumen_pegawai->tanggal_pengajuan ?></td>
                <td><?php echo $dokumen_pegawai->nomor_pengajuan ?></td>
                <!-- <td class="text-center">
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
                </td> -->
                <td>
                    
                        <a href="{{ asset('assets/upload/file/'.$dokumen_pegawai->gambar) }}" class="btn btn-success btn-xs" title="Unduh" target="_blank"><i class="fa fa-download"></i> Unduh</a>
   
                    

                    <a href="{{ asset('admin/dokumen-pegawai/delete/'.$dokumen_pegawai->id_dokumen_pegawai) }}" class="btn btn-secondary btn-xs delete-link">
                        <i class="fa fa-trash"></i></a>
                </td>
                </tr>

            <?php $i++;
            } ?>

        </tbody>
    </table>
</form>