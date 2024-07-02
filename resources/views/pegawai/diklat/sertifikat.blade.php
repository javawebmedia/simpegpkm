<div class="modal fade" id="lihat_<?php echo Session()->get('id_pegawai') ?>">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lihat Sertifikat: <?php echo $diklat->nama_diklat ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td width="90%">
                                <iframe src="<?php echo asset('assets/upload/file/'.$diklat->sertifikat) ?>" height="300" style="width:100%;" allowfullscreen webkitallowfullscreen></iframe>
                            </td>
                            <td>
                                <a href="{{ asset('pegawai/diklat/delete/'.$diklat->sertifikat) }}?pengalihan=<?php echo url()->full(); ?>" class="btn btn-secondary btn-xs delete-link"><i class="fa fa-trash"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>