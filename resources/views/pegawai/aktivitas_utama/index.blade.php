<p>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
      <i class="fa fa-plus-circle"></i> Tambah Rencana Kinerja
    </button>
</p>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@include('pegawai/aktivitas_utama/tambah')

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="35%">Nama Aktivitas</th>
            <th width="15%">Waktu</th>
            <th width="15%">Satuan</th>
            <th width="15%">Jenis</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $jumlah = 0;
        $no=1; foreach($aktivitas_utama as $aktivitas_utama) { ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $aktivitas_utama->nama_aktivitas }}</td>
            <td>{{ $aktivitas_utama->waktu }} Menit</td>
            <td>{{ $aktivitas_utama->nama_satuan }}</td>
            <td>{{ $aktivitas_utama->jenis_aktivitas_utama }}</td>
            <td>
                <a href="{{ asset('pegawai/aktivitas-utama/delete/'.$aktivitas_utama->id_aktivitas_utama) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i> Hapus</a>
            </td>
        </tr>
        <?php 
        $jumlah+=$aktivitas_utama->waktu;
        $no++; } ?>
        <tr class="bg-light">
            <td colspan="2">Jumlah</td>
            <td colspan="4">{{ $jumlah }}</td>
        </tr>
    </tbody>
</table>