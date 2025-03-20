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
		<button type="button" class="btn btn-new text-white btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#menu_baru"><i class="fa-regular fa-square-plus"></i> Tambah</button>
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
		<a href="<?=base_url('admin_page/urutan_menu');?>" class="btn btn-new text-white mb-3 btn-sm"><i class="fa-solid fa-sort"></i> Urutkan Menu</a>
		<div class="card shadow">
			<div class="card-header text-white bg-new">
				List Menu
			</div>
			<div class="card-body">
				<div class="input-group input-group-sm mb-3">
					<span class="input-group-text" id="basic-addon1">Filter : </span>
					<input type="text" class="form-control" placeholder="Main Page" id="filterInput" aria-label="Filter by Main Page" aria-describedby="basic-addon1">
				</div>
				<div class="table-responsive" style="height: 600px;">
					<table class="table table-striped table-hover table-sm table-bordered" id="list">
						<thead class="bg-success text-white sticky-top top-0">
							<tr>
								<th>#</th>
								<th>Main Page</th>
								<th>Nama Menu</th>
								<th>Icon Menu</th>
								<th>Url Menu</th>
								<th>Urutan Menu</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($list as $ls) : ?>
								<tr data-id="<?=$ls->id_menu;?>">
									<td><?=$no++;?></td>
									<td><?=$ls->nama_main_page;?></td>
									<td><?=$ls->nama_menu;?></td>
									<td><i class="<?=$ls->icon_menu;?>"></i></td>
									<td><?=$ls->url_menu;?></td>
									<td><?=$ls->urutan_menu;?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</main>

<div class="modal fade" id="menu_baru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Menu Baru</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-3 col-form-label">Main Page</label>
					<div class="col-sm-9">
						<select name="id_main_page" id="id_main_page" class="form-select form-select-sm">
							<option selected disabled value=" ">== Pilih ==</option>
							<?php
							$query 	= "SELECT * FROM tbl_main_page";
							$data 	= $this->db->query($query)->result_array();
							foreach ($data as $dt) : ?>
								<option value="<?=$dt['id_main_page'];?>"><?=$dt['nama_page'];?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-3 col-form-label">Nama Menu</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" id="nama_menu" name="nama_menu" autocomplete="off">
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-3 col-form-label">Icon Menu</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" id="icon_menu" name="icon_menu" autocomplete="off">
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-3 col-form-label">Url Menu</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" id="url_menu" name="url_menu" autocomplete="off">
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-3 col-form-label">Aktif</label>
					<div class="col-sm-9">
						<input class="form-check-input" type="checkbox" value="" id="aktif" checked disabled>
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-3 col-form-label">Visible</label>
					<div class="col-sm-9">
						<input class="form-check-input" type="checkbox" value="" id="visible" checked disabled>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> Tutup</button>
				<button type="button" class="btn btn-success btn-sm" onclick="simpan_menu_baru();"><i class="fa-regular fa-paper-plane"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="menu_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Edit Menu</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-3 col-form-label">Nama Menu</label>
					<div class="col-sm-9">
						<input type="hidden" class="form-control form-control-sm" id="id_menu_edit" name="id_menu_edit" autocomplete="off">
						<input type="text" class="form-control form-control-sm" id="nama_menu_edit" name="nama_menu_edit" autocomplete="off">
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-3 col-form-label">Icon Menu</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" id="icon_menu_edit" name="icon_menu_edit" autocomplete="off" disabled>
					</div>
				</div>
				<div class="mb-2 row">
					<label for="staticEmail" class="col-sm-3 col-form-label">Url Menu</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" id="url_menu_edit" name="url_menu_edit" autocomplete="off" disabled>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> Tutup</button>
				<button type="button" class="btn btn-success btn-sm" onclick="simpan_edit_menu();"><i class="fa-regular fa-paper-plane"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
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
				parsebtn($(this).attr('id'), selectedRowId)
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

		$('#filterInput').on('keyup', function() {
			var filterValue = $(this).val().toLowerCase();

			$('#list tbody tr').filter(function() {
				$(this).toggle($(this).find('td').eq(1).text().toLowerCase().indexOf(filterValue) > -1);
			});
		});
	});

	function simpan_menu_baru() {
		var id 		= $('#id_main_page').val();
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
				url 	: '<?=base_url('admin_page/simpan_menu_baru');?>',
				dataType: 'JSON',
				data 	: {id : id, nama : nama, icon : icon.slice(10,-6), url : url},
				success : function(data) {
					Swal.close();
					$('#menu_baru').modal('hide');
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

	function edit(a) {
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('admin_page/check_available_menu');?>',
			dataType: 'JSON',
			data 	: {id : a},
			success : function(data) {
				if(data.length != 0) {
					Swal.fire({
						title: "Yakin?",
						text: "Ada yang memiliki akses pada Menu ini, yakin akan merubahnya!",
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						confirmButtonText: "Ya, Ubah!",
						cancelButtonText: "Batal"
					}).then((result) => {
						if (result.isConfirmed) {
							form_edit(a);
						}
					});
				} else {
					form_edit(a);
				}
			}
		});
	}

	function form_edit(a) {
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('admin_page/get_menu_by_id');?>',
			dataType: 'JSON',
			data 	: {id : a},
			success : function(data) {
				if(data.length == 0) {
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "Data Tidak Ditemukan!"
					});
				} else {
					$('#menu_edit').modal('show');
					$('#menu_edit').on('shown.bs.modal', function(e) {
						var ida 	= "";
						var n_page 	= "";
						var u_page 	= "";
						var i_page 	= "";
						var m_page 	= "";
						for(var a = 0; a < data.length; a++) {
							ida 	+= data[a].id_menu;
							n_page 	+= data[a].nama_menu;
							u_page 	+= data[a].url_menu;
							i_page 	+= data[a].icon_menu;
						}
						$('#id_menu_edit').val(ida);
						$('#nama_menu_edit').val(n_page);
						$('#url_menu_edit').val(u_page);
						$('#icon_menu_edit').val(i_page);
					});
				}
			}
		});
	}

	function simpan_edit_menu() {
		var id_menu 	= $('#id_menu_edit').val();
		var nama_menu 	= $('#nama_menu_edit').val();

		if(!nama_menu) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Nama Menu Tidak Boleh Kosong!'
			});
		} else {
			$.ajax({
				type 	: 'POST',
				url 	: '<?=base_url('admin_page/simpan_edit_menu');?>',
				dataType: 'JSON',
				data 	: {id : id_menu, nama : nama_menu},
				success	: function(data) {
					$('#menu_edit').modal('hide');
					Swal.fire({
						title: "Berhasil!",
						text: data,
						icon: "success"
					}).then((result) => {
						if (result.isConfirmed) {
							location.reload();
						}
					});
				}
			});
		}
	}

	function nonaktifkan(a) {
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('admin_page/check_available_menu');?>',
			dataType: 'JSON',
			data 	: {id : a},
			success : function(data) {
				if(data.length != 0) {
					Swal.fire({
						title: "Yakin?",
						text: "Ada yang memiliki akses pada Menu ini.. Jika Anda menonaktifkan menu ini, semua pegawai yang memiliki akses ini tidak bisa masuk ke menu ini.. yakin akan menonaktifkannya?",
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						confirmButtonText: "Ya, Ubah!",
						cancelButtonText: "Batal"
					}).then((result) => {
						if (result.isConfirmed) {
							go_nonaktifkan(a);
						}
					});
				} else {
					go_nonaktifkan(a);
				}
			}
		});
	}

	function go_nonaktifkan(a) {
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('admin_page/aktifnonaktif_menu');?>',
			dataType: 'JSON',
			data 	: {id : a},
			success : function(data) {
				Swal.fire({
					title: "Berhasil!",
					text: data,
					icon: "success"
				}).then((result) => {
					if (result.isConfirmed) {
						location.reload();
					}
				});
			}
		});
	}

	function parsebtn(nama, id) {
		if(nama == "edit") {
			edit(id);
		} else {
			nonaktifkan(id);
		}
	}
</script>