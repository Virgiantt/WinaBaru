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
		<button class="btn btn-new text-white btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#tambah_data"><i class="fa-regular fa-square-plus"></i> Tambah Main Page</button>
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
		<a href="<?=base_url('admin_page/urutan_main_page');?>" class="btn btn-new text-white btn-sm mb-3"><i class="fa-solid fa-sort"></i> Urutkan Main Page</a>
		<div class="card shadow">
			<div class="card-header text-white bg-new">
				List Main Page
			</div>
			<div class="card-body">
				<div class="table-responsive" style="height: 650px;">
					<table class="table table-striped table-hover table-sm table-bordered" id="list">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Url</th>
								<th>Icon</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no 	= 1;
							foreach ($list as $ls) : ?>
								<tr data-id="<?=$ls->id_main_page;?>">
									<td><?=$no++;?></td>
									<td><?=$ls->nama_main_page;?></td>
									<td><?=$ls->url_main_page;?></td>
									<td><img src="<?=base_url('assets/img/images/')?><?=$ls->icon_main_page;?>" alt="" height="50"></td>
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
			<form id="upload_form" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Main Page</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-2 row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Nama</label>
						<div class="col-sm-9">
							<input type="text" class="form-control form-control-sm" name="nama_page" id="nama_page" autocomplete="off">
						</div>
					</div>
					<div class="mb-2 row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Url</label>
						<div class="col-sm-9">
							<input type="text" class="form-control form-control-sm" name="url_page" id="url_page" autocomplete="off">
							<input type="hidden" class="form-control form-control-sm" name="icon_page" id="icon_page" autocomplete="off">
						</div>
					</div>
					<div class="mb-2 row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Image</label>
						<div class="col-sm-9">
							<input type="file" class="form-control form-control-sm" name="photo" id="photo" onchange="document.getElementById('load_img').src = window.URL.createObjectURL(this.files[0]);$('#load_img').show();">
							<br>
							<center><img class="img-thumbnail" id="load_img" width="300" /></center>
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
					<button type="submit" class="btn btn-success btn-sm"><i class="fa-regular fa-paper-plane"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="edit_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form id="upload_form" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Main Page</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-2 row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Nama</label>
						<div class="col-sm-9">
							<input type="hidden" class="form-control form-control-sm" name="id_page_edit" id="id_page_edit" autocomplete="off">
							<input type="text" class="form-control form-control-sm" name="nama_page_edit" id="nama_page_edit" autocomplete="off">
						</div>
					</div>
					<div class="mb-2 row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Url</label>
						<div class="col-sm-9">
							<input type="text" class="form-control form-control-sm" name="url_page_edit" id="url_page_edit" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> Tutup</button>
					<button type="button" class="btn btn-success btn-sm" onclick="simpan_edit_data();"><i class="fa-regular fa-paper-plane"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="edit_gambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form id="upload_form1" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Gambar Main Page</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-2 row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Gambar</label>
						<div class="col-sm-9" id="t_image">
						</div>
					</div>
					<div class="mb-2 row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Ganti Gambar</label>
						<div class="col-sm-9">
							<input type="hidden" class="form-control form-control-sm" name="gambar_lama" id="gambar_lama">
							<input type="file" class="form-control form-control-sm" name="photo" id="photo" onchange="document.getElementById('new_image').src = window.URL.createObjectURL(this.files[0]);$('#new_image').show();">
							<br>
							<center><img class="img-thumbnail" id="new_image" width="300" /></center>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> Tutup</button>
					<button type="submit" class="btn btn-success btn-sm"><i class="fa-regular fa-paper-plane"></i> Simpan</button>
				</div>
			</form>
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
				parsebtn($(this).attr('id'),selectedRowId);
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

	$('#upload_form').on('submit', function(e){
		e.preventDefault();
		if($('#nama_page').val() == "") {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon Nama Diisi Terlebih Dahulu!'
			});
		} else if($('#url_page').val() == "") {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon Url Diisi Terlebih Dahulu!'
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
				method 		: 'POST',
				url 		: '<?=base_url('admin_page/simpan_main_page_baru');?>',
				data 		: new FormData(this),
				contentType : false,
				cache 		: false,
				processData : false,
				success 	: function(data) {
					Swal.close();
					$('#tambah_tangki').modal('hide');
					Swal.fire({
						icon: 'success',
						title: 'Berhasil',
						text: 'Data Main Page Baru Berhasil Disimpan!'
					}).then((result) => {
						location.reload();
					});
				}
			});
		}
	});

	$('#upload_form1').on('submit', function(e){
		e.preventDefault();
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
			method 		: 'POST',
			url 		: '<?=base_url('admin_page/simpan_edit_gambar_main_page');?>',
			data 		: new FormData(this),
			contentType : false,
			cache 		: false,
			processData : false,
			success 	: function(data) {
				Swal.close();
				$('#edit_gambar').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Berhasil',
					text: 'Gambar Berhasil Dirubah!'
				}).then((result) => {
					location.reload();
				});
			}
		});
	});

	function parsebtn(nama, id) {
		if(nama == "edit") {
			edit(id);
		} else if(nama == "ubah_gambar") {
			edit_gambar(id);
		} else {
			nonaktifkan(id);
		}
	}

	function edit(a) {
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('admin_page/check_available_main_page');?>',
			dataType: 'JSON',
			data 	: {id : a},
			success : function(data) {
				if(data.length != 0) {
					Swal.fire({
						title: "Yakin?",
						text: "Ada yang memiliki akses pada menu Main Page ini, yakin akan merubahnya!",
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
			url 	: '<?=base_url('admin_page/get_main_page_edit_by_id');?>',
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
					$('#edit_data').modal('show');
					$('#edit_data').on('shown.bs.modal', function(e) {
						var ida 	= "";
						var n_page 	= "";
						var u_page 	= "";
						var i_page 	= "";
						var m_page 	= "";
						for(var a = 0; a < data.length; a++) {
							ida 	+= data[a].id_main_page;
							n_page 	+= data[a].nama_main_page;
							u_page 	+= data[a].url_main_page;
						}
						$('#id_page_edit').val(ida);
						$('#nama_page_edit').val(n_page);
						$('#url_page_edit').val(u_page);
						$('#icon_page_edit').val(i_page);
					});
				}
			}
		});
	}

	function simpan_edit_data() {
		var id 		= $('#id_page_edit').val();
		var nama 	= $('#nama_page_edit').val();
		var url 	= $('#url_page_edit').val();
		console.log(id);
		console.log(nama);
		console.log(url);
		if(!nama) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon Nama Diisi Terlebih Dahulu!'
			});
		} else if(!url) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Mohon Url Diisi Terlebih Dahulu!'
			});
		} else {
			$.ajax({
				type 	: 'POST',
				url 	: '<?=base_url('admin_page/simpan_edit_main_page');?>',
				dataType: 'JSON',
				data 	: {id : id, nama : nama, url : url},
				success : function(data) {
					$('#edit_data').modal('hide');
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

	function edit_gambar(a) {
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('admin_page/get_main_page_edit_by_id');?>',
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
					console.log(data);
					$('#edit_gambar').modal('show');
					$('#edit_gambar').on('shown.bs.modal', function(e) {
						var ida 	= "";
						var m_page 	= "";
						for(var a = 0; a < data.length; a++) {
							ida 	+= data[a].id_main_page;
							m_page 	+= data[a].icon_main_page;
						}
						var t_image = `<input type="hidden" class="form-control form-control-sm" name="id_page_edit_image" id="id_page_edit_image" value="`+ida+`"><img class="img-thumbnail" id="old_image" width="300" src="<?=base_url('assets/img/images/');?>`+m_page+`" /></center>`
						$('#gambar_lama').val(m_page);
						$('#t_image').html(t_image);
					});
				}
			}
		});
	}

	function nonaktifkan(a) {
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('admin_page/check_available_main_page');?>',
			dataType: 'JSON',
			data 	: {id : a},
			success : function(data) {
				if(data.length != 0) {
					Swal.fire({
						title: "Yakin?",
						text: "Ada yang memiliki akses pada menu Main Page ini.. Jika Anda menonaktifkan menu ini, semua pegawai yang memiliki akses ini tidak bisa masuk ke menu ini.. yakin akan menonaktifkannya?",
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						confirmButtonText: "Ya, Nonaktifkan!",
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
			url 	: '<?=base_url('admin_page/aktifnonaktif_main_page');?>',
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
</script>