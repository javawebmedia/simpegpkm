<p>
    <a href="{{ asset('pegawai/str-sip/tambah') }}" class="btn btn-info">
        <i class="fa fa-plus-circle"></i> Tambah Baru
    </a>
</p>

<table class="table table-bordered table-sm" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Jenis</th>
            <th>Nomor STR/SIP</th>
            <th>Tanggal Terbit</th>
            <th>Tanggal Berakhir</th>
            <th>Status Seumur Hidup</th>
            <th>Status Approval</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($str_sip as $str_sip) { ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $str_sip->jenis_str_sip }}</td>
            <td>{{ $str_sip->nomor_sertifikat }}</td>
            <td>{{ date('d-m-Y',strtotime($str_sip->tanggal_lulus)) }}</td>
            <td>{{ date('d-m-Y',strtotime($str_sip->tanggal_akhir)) }}</td>
            <td>{{ $str_sip->seumur_hidup }}</td>
            <td>{{ $str_sip->status_str_sip }}</td>
            <td>
                <a href="{{ asset('assets/upload/file/'.$str_sip->gambar) }}" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf"></i> Unduh</a>

                <a href="{{ asset('pegawai/str-sip/edit/'.$str_sip->id_str_sip) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

                <a href="{{ asset('pegawai/str-sip/hapus/'.$str_sip->id_str_sip) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>