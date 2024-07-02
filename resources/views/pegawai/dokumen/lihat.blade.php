
 <div class="modal fade" id="lihat_<?php echo $id_jenis_dokumen ?>_<?php echo $id_sub_jenis_dokumen ?>">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Lihat Dokumen: <?php echo $sub_jenis_dokumen->nama_sub_jenis_dokumen ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<table class="table">
            		
            		<tbody>
            			<?php foreach($dokumen as $dokumen) { ?>
            			<tr>
            				<td width="90%">
            					<iframe src="<?php echo asset('assets/upload/file/'.$dokumen->gambar) ?>"  height="300" style="width:100%;" allowfullscreen webkitallowfullscreen></iframe>
            				</td>
            				<td>
            					<a href="{{ asset('pegawai/dokumen/delete/'.$dokumen->kode_dokumen_pegawai) }}?pengalihan=<?php echo url()->full(); ?>" class="btn btn-secondary btn-xs delete-link"><i class="fa fa-trash"></i></a>
            				</td>
            			</tr>
            				<?php } ?>
            		</tbody>
            	</table>
						
						
				

			</div>
			<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
		</div>
	</div>
</div>
