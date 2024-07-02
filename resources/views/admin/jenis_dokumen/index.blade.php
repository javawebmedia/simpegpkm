@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<p>
    @include('admin/jenis_dokumen/tambah')
</p>
<form action="{{ asset('admin/jenis-dokumen/proses') }}" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="row pb-2">
        <div class="col-md-12">
            <button class="btn btn-dark" type="submit" name="hapus" onClick="check();">
                <i class="fa fa-trash"></i>
            </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus-circle"></i> Tambah Baru
            </button>
        </div>
    </div>

    <table class="tabelnya table-sm" id="example1">
        <thead>
            
                <th width="5%">NO</th>
                <th width="20%">NAMA</th>
                <th width="15%">KODE</th>
                <th width="10%">NO.URUT</th>
                <th width="20%">SUB JENIS</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
            foreach ($jenis_dokumen as $jenis_dokumen) {
                $sub_jenis_dokumen = $m_sub_jenis_dokumen->jenis_dokumen($jenis_dokumen->id_jenis_dokumen);
             ?>
             <tr>
                <td class="text-center">
                    <input class="form-check-input" type="checkbox" name="id_jenis_dokumen[]" value="<?php echo $jenis_dokumen->id_jenis_dokumen ?>" id="gridCheck<?php echo $i ?>">
                </td>
                <td><?php echo $jenis_dokumen->nama_jenis_dokumen ?></td>
                <td><?php echo $jenis_dokumen->kode_jenis_dokumen ?></td>
                <td><?php echo $jenis_dokumen->urutan ?></td>
                <td><ul class="ml-0 pl-0">
                    <?php foreach($sub_jenis_dokumen as $sub_jenis_dokumen) { ?>
                        <li><?php echo $sub_jenis_dokumen->nama_sub_jenis_dokumen ?></li>
                    <?php } ?>
                </ul>
                </td>
                <td>
                    <?php if ($jenis_dokumen->status_jenis_dokumen == 'Aktif') { ?>
                        <span class="badge bg-success">{{ $jenis_dokumen->status_jenis_dokumen }}</span>
                    <?php } else { ?>
                        <span class="badge bg-danger">{{ $jenis_dokumen->status_jenis_dokumen }}</span>
                    <?php } ?>
                </td>
                <td>
                    <a href="{{ asset('admin/jenis-dokumen/sub/'.$jenis_dokumen->id_jenis_dokumen) }}" class="btn btn-info btn-xs"><i class="fa fa-sitemap"></i> Sub Jenis</a>

                    <a href="{{ asset('assets/upload/jenis_dokumen/'.$jenis_dokumen->gambar) }}" class="btn btn-success btn-xs"><i class="fa fa-download"></i></a>

                    <a href="{{ asset('admin/jenis-dokumen/edit/'.$jenis_dokumen->id_jenis_dokumen) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

                    <a href="{{ asset('admin/jenis-dokumen/delete/'.$jenis_dokumen->id_jenis_dokumen) }}" class="btn btn-secondary btn-xs delete-link">
                        <i class="fa fa-trash"></i></a>
                </td>
                </tr>

            <?php $i++;
            } ?>

        </tbody>
    </table>
</form>