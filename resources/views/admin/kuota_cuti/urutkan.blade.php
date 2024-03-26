

<p class="text-right">
	<a href="<?php echo asset('admin/kuota_cuti') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<div class="box mb-5">
	<ul class="list-unstyled" id="page_list">
		<?php foreach($kuota_cuti as $kuota_cuti) { ?>
			<li id="<?php echo $kuota_cuti->id_kuota_cuti ?>"><i class="fa fa-bars"></i> <?php echo $kuota_cuti->nama_kuota_cuti ?></li>
		<?php } ?>
	</ul>
	<input type="hidden" name="page_order_list" id="page_order_list" />
</div>

<script>
	$(document).ready(function(){
		$( "#page_list" ).sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui)
			{
				var page_id_array = new Array();
				$('#page_list li').each(function(){
					page_id_array.push($(this).attr("id"));
				});
				$.ajax({
					url:"<?php echo asset('admin/kuota_cuti/urutkan') ?>",
					method:"POST",
					data:{page_id_array:page_id_array},
					success:function(data)
					{
						Swal.fire({
								      icon: 'success',
								      heightAuto: false,
								      timer: 3000,
								      title: 'Sukses...',
								      text: 'Metode pengadaan berhasil diurutkan.',
								    });
					}
				});
			}
		});

	});
</script>