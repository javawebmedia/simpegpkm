<div class="modal fade" id="lihat_<?php echo $diklat->id_diklat ?>">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lihat Sertifikat: <?php echo $diklat->nama_diklat ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row mt-2">
    
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <strong>DETAIL DIKLAT</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm tabelku">
                                <tbody>
                                    <tr>
                                        <td width="40%">Nama Diklat</td>
                                        <td>{{ $diklat->nama_diklat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Metode</td>
                                        <td>{{ $diklat->jenis_metode }} - {{ $diklat->nama_metode_diklat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rumpun</td>
                                        <td>{{ $diklat->nama_rumpun }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Pelatihan</td>
                                        <td>{{ $diklat->nama_jenis_pelatihan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kode Diklat</td>
                                        <td>{{ $diklat->kode_diklat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Kode Diklat</td>
                                        <td>{{ $diklat->nama_kode_diklat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Diklat</td>
                                        <td>{{ $diklat->status_diklat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai</td>
                                        <td>{{ $diklat->tanggal_awal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Selesai</td>
                                        <td>{{ $diklat->tanggal_akhir }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penyelenggara</td>
                                        <td>{{ $diklat->tempat_pelaksanaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Durasi</td>
                                        <td>{{ $diklat->durasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>JPL</td>
                                        <td>{{ $diklat->jpl }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Sertifikat</td>
                                        <td>{{ $diklat->nomor_sertifikat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Sertifikat</td>
                                        <td>{{ $diklat->tanggal_sertifikat }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <strong>DETAIL SERTIFIKAT (JIKA ADA)</strong>
                        </div>
                        <div class="card-body">
                            <iframe src="<?php echo asset('assets/upload/file/'.$diklat->sertifikat) ?>" height="450" style="width:100%;" allowfullscreen webkitallowfullscreen></iframe>


                        </div>
                    </div>
    </div>
</div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>