<style>
	.bg-new {
		background: rgb(0,17,87);
		background: linear-gradient(29deg, rgba(0,17,87,1) 0%, rgba(2,175,209,1) 95%, rgba(0,209,255,1) 100%);
	}
	.btn-new {
		background-color: #070074;
	}
</style>
<style>
	.selected-row {
		background-color: #5eaff8;
		color: white;
	}

	tbody tr:hover {
		background-color: lightblue;
		cursor: pointer;
	}
</style>
<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
		<hr>
		<button type="button" class="btn btn-new text-white btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#tambah_data"><i class="fa-regular fa-square-plus"></i> Tambah</button>
		<?php
		$url1 	= $this->uri->segment(1);
		$url2 	= $this->uri->segment(2);
		$url3 	= $url1."/".$url2;
		$id_mn 	= "";

		$query 	= "SELECT id_menu FROM tbl_menu WHERE url_menu='$url3'";
		$data 	= $this->db->query($query)->result_array();
		foreach ($data as $dt) {
			$id_mn = $dt['id_menu'];
		}

		$query2 = "SELECT tbl_akses_proses.id_akses_proses, tbl_akses_proses.id_jabatan, tbl_akses_proses.id_proses, tbl_proses.id_menu, tbl_proses.nama_proses, tbl_proses.icon_proses, tbl_proses.url_proses, tbl_proses.urutan_proses FROM tbl_akses_proses INNER JOIN tbl_proses ON tbl_akses_proses.id_proses = tbl_proses.id_proses WHERE tbl_proses.id_menu = '$id_mn'";
		$data2 	= $this->db->query($query2)->result_array(); 
		foreach ($data2 as $dt2) : ?>
			<?php $iii 	= strtolower(str_replace(" ", "_", $dt2['nama_proses']));?>
			<button id="<?=$iii;?>" class="btn btn-new text-white btn-sm disabled mb-3 lbtn"><i class="<?=$dt2['icon_proses'];?>"></i> <?=$dt2['nama_proses'];?></button>
		<?php endforeach; ?>
		<a href="<?=base_url('admin_page/urutan_proses');?>" class="btn btn-new text-white mb-3 btn-sm"><i class="fa-solid fa-sort"></i> Urutkan Proses</a>
		<div class="card shadow">
			<div class="card-header text-white bg-new">
				List Proses
			</div>
			<div class="card-body">
				<div class="table-responsive" style="height: 650px;">
					<table class="table table-striped table-hover table-sm table-bordered" id="list">
						<thead>
							<tr>
								<th>#</th>
								<th>Menu</th>
								<th>Nama Proses</th>
								<th>Icon Proses</th>
								<th>Url Proses</th>
								<th>Urutan Proses</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no 	= 1;
							foreach ($list as $ls) : ?>
								<tr data-id="<?=$ls->id_proses;?>">
									<td><?=$no++;?></td>
									<td><?=$ls->nama_menu;?></td>
									<td><?=$ls->nama_proses;?></td>
									<td><?=$ls->icon_proses;?></td>
									<td><?=$ls->url_proses;?></td>
									<td><?=$ls->urutan_proses;?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="modal fade" id="tambah_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-4 col-form-label">Main Page</label>
					<div class="col-sm-8">
						<select name="id_main_page" id="id_main_page" class="form-select form-select-sm">
							<option selected disabled value=" ">== Pilih ==</option>
							<?php
							$query 	= "SELECT * FROM tbl_main_page";
							$data 	= $this->db->query($query)->result_array();
							foreach ($data as $dt) : ?>
								<option value="<?=$dt['id_main_page'];?>"><?=$dt['nama_main_page'];?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-4 col-form-label">Menu</label>
					<div class="col-sm-8">
						<select name="id_menu" id="id_menu" class="form-select form-select-sm">
							<option selected disabled value=" ">== Pilih Main Page Dahulu ==</option>
						</select>
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-4 col-form-label">Nama Proses</label>
					<div class="col-sm-8">
						<input type="text" class="form-control form-control-sm" id="nama_menu" name="nama_menu" autocomplete="off">
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-4 col-form-label">Icon Proses</label>
					<div class="col-sm-8">
						<input type="text" class="form-control form-control-sm" id="icon_menu" name="icon_menu" autocomplete="off">
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-4 col-form-label">Url Proses</label>
					<div class="col-sm-8">
						<input type="text" class="form-control form-control-sm" id="url_menu" name="url_menu" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> Tutup</button>
				<button type="button" class="btn btn-success btn-sm" onclick="simpan_proses_baru();"><i class="fa-regular fa-paper-plane"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var selectedRowId = null;

		$('table tbody tr').click(function (event) {
			event.stopPropagation();
			$('table tbody tr').removeClass('selected-row');
			$(this).addClass('selected-row');
			selectedRowId = $(this).data('id');
			$('.lbtn').removeClass('disabled');
		});

		$('.lbtn').click(function () {
			if (!$(this).hasClass('disabled')) {
				alert('Button ID: ' + $(this).attr('id') + ', Selected Row ID: ' + selectedRowId);
			}
		});

		$(document).click(function () {
			$('table tbody tr').removeClass('selected-row');
			$('.lbtn').addClass('disabled');
			selectedRowId = null;
		});

		$('table').click(function (event) {
			event.stopPropagation();
		});
	});

	$('#id_main_page').on('change', function(){
		var id 	= $('#id_main_page').val();
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('admin_page/get_menu_by_main_page');?>',
			dataType: 'JSON',
			data 	: {id : id},
			success : function(data) {
				if(data.length < 1) {
					var list = '<option disabled selected value=" ">Tidak Ada Menu</option>';
					$('#id_menu').html(list);
				} else {
					var list = '<option selected disabled value=" ">== Pilih Menu ==</option>';
					for (var a = 0; a < data.length; a++) {
						list += '<option value="'+data[a].id_menu+'">'+data[a].nama_menu+'</option>';
					}
					$('#id_menu').html(list);
				}
			}
		});
	});

	function simpan_proses_baru() {
		var id 		= $('#id_main_page').val();
		var idm		= $('#id_menu').val();
		var nama 	= $('#nama_menu').val();
		var icon 	= $('#icon_menu').val();
		var url 	= $('#url_menu').val().trim();
		var c_url 	= checkUrl(url);

		if(!id) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon Pilih Main Page Terlebih Dahulu!'
			});
		} else if(!idm) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon Pilih Menu Terlebih Dahulu!'
			});
		} else if(!nama) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon Nama Menu Diisi Terlebih Dahulu!'
			});
		} else if(!icon) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon Icon Menu Diisi Terlebih Dahulu!'
			});
		} else if(!url) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon Url Menu Diisi Terlebih Dahulu!'
			});
		} else if(c_url == true) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Url Tidak Boleh Menggunakan Spasi!'
			});
		} else if(!isNaN(url)) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Url Hanya Boleh Menggunakan Huruf!'
			});
		} else {
			var showLoading = function() {
				Swal.fire({
					title 		: 'Mohon Tunggu!',
					html 		: 'Sedang Mengambil Data ...',
					allowOutsideClick 	: false,
					showConfirmButton 	: false,
					willOpen: () => {
						Swal.showLoading()
					},
				});
			}
			showLoading();

			$.ajax({
				type 	: 'POST',
				url 	: '<?=base_url('admin_page/simpan_proses_baru');?>',
				dataType: 'JSON',
				data 	: {id : id, idm : idm, nama : nama, icon : icon.slice(10,-6), url : url},
				success : function(data) {
					Swal.close();
					$('#tambah_data').modal('hide');
					Swal.fire({
						icon: 'success',
						title: 'Berhasil',
						text: data
					}).then((result) => {
						location.reload();
					});
				}
			});
		}
	}

	function checkUrl(value) {
		return value.indexOf(' ') >= 0;
	}
</script>