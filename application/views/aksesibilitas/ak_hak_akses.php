<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
		<hr>
		<div class="card border-primary">
			<div class="card-header bg-primary text-white">
				Pilih Jabatan Terlebih Dahulu
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover table-sm table-bordered table-bordered" id="list">
					<thead>
						<tr>
							<th>#</th>
							<th>Kode Jabatan</th>
							<th>Nama Jabatan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no 	= 1;
						foreach ($list as $ls) : ?>
							<tr>
								<td><?=$no++;?></td>
								<td><?=$ls->kode_jabatan;?></td>
								<td><?=$ls->nama_jabatan;?></td>
								<td><button type="button" class="btn btn-success btn-sm" onclick="toaccess(<?=$ls->id_jabatan;?>,'<?=$ls->nama_jabatan;?>');"><i class="fa-solid fa-user-tag"></i> Berikan Akses</button></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="card-footer">
				Test
			</div>
		</div>
	</div>
</main>

<!-- <div class="modal fade" id="tambah_akses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-12" id="menu">
						<center><strong>Menu</strong></center>
						<hr>
						<table class="table table-striped table-hover table-sm table-bordered" id="list_menu">
							<thead>
								<tr style="text-align: center;">
									<th>#</th>
									<th>Nama</th>
									<th>Akses</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12" id="dashboard">
						<center><strong>Main Page</strong></center>
						<hr>
						<table class="table table-striped table-hover table-sm table-bordered" id="list_dashboard">
							<thead>
								<tr style="text-align: center;">
									<th>#</th>
									<th>Nama</th>
									<th>Akses</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12" id="sidemenu">
						<center><strong>Sidemenu</strong></center>
						<hr>
						<table class="table table-striped table-hover table-sm table-bordered" id="list_sidemenu">
							<thead>
								<tr style="text-align: center;">
									<th>#</th>
									<th>Nama</th>
									<th>Akses</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12" id="proses">
						<center><strong>Proses</strong></center>
						<hr>
						<table class="table table-striped table-hover table-sm table-bordered" id="list">
							<thead>
								<tr style="text-align: center;">
									<th>#</th>
									<th>Nama</th>
									<th>Akses</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no 	= 1;
								$query4 = "SELECT * FROM tbl_proses";
								$data4 	= $this->db->query($query4)->result_array();
								foreach ($data4 as $dt4) : ?>
									<tr>
										<td><?=$no++;?></td>
										<td><?=$dt4['nama_proses'];?></td>
										<td>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="check_proses">
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> Tutup</button>
				<button type="button" class="btn btn-primary btn-sm"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
			</div>
		</div>
	</div>
</div> -->

<!-- <div class="modal fade" id="tambah_akses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php
				$query = "SELECT p.id_proses, p.nama_proses, p.icon_proses, p.url_proses, p.urutan_proses, p.prefix_proses, m.nama_menu, m.icon_menu, m.url_menu, m.urutan_menu, m.prefix_menu, m.id_menu, e.id_main_page, e.nama_main_page, e.url_main_page, e.icon_main_page, e.urutan_main_page, e.aktif, e.visible FROM tbl_proses p INNER JOIN tbl_menu m ON p.id_menu = m.id_menu INNER JOIN tbl_main_page e ON m.id_main_page = e.id_main_page";
				$result = $this->db->query($query)->result_array();

				$treeData = [];
				foreach ($result as $row) {
					$mainPageId = $row['id_main_page'];
					$menuId = $row['id_menu'];

					if (!isset($treeData[$mainPageId])) {
						$treeData[$mainPageId] = [
							'nama_main_page' => $row['nama_main_page'],
							'menus' => []
						];
					}

					if (!isset($treeData[$mainPageId]['menus'][$menuId])) {
						$treeData[$mainPageId]['menus'][$menuId] = [
							'nama_menu' => $row['nama_menu'],
							'proses' => []
						];
					}

					$treeData[$mainPageId]['menus'][$menuId]['proses'][] = [
						'id_proses' => $row['id_proses'],
						'nama_proses' => $row['nama_proses']
					];
				}
				?>
				<div class="table-responsive" style="height: 550px">
					<div class="accordion" id="accordionMainPage">
						<?php foreach ($treeData as $mainPageId => $mainPage): ?>
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingMainPage<?= $mainPageId ?>">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMainPage<?= $mainPageId ?>" aria-expanded="true" aria-controls="collapseMainPage<?= $mainPageId ?>">
										<?= $mainPage['nama_main_page'] ?>
									</button>
								</h2>
								<div id="collapseMainPage<?= $mainPageId ?>" class="accordion-collapse collapse" aria-labelledby="headingMainPage<?= $mainPageId ?>" data-bs-parent="#accordionMainPage">
									<div class="accordion-body">
										<div class="accordion" id="accordionMenu<?= $mainPageId ?>">
											<?php foreach ($mainPage['menus'] as $menuId => $menu): ?>
												<div class="accordion-item">
													<h2 class="accordion-header" id="headingMenu<?= $menuId ?>">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMenu<?= $menuId ?>" aria-expanded="false" aria-controls="collapseMenu<?= $menuId ?>">
															<?= $menu['nama_menu'] ?>
														</button>
													</h2>
													<div id="collapseMenu<?= $menuId ?>" class="accordion-collapse collapse" aria-labelledby="headingMenu<?= $menuId ?>" data-bs-parent="#accordionMenu<?= $mainPageId ?>">
														<div class="accordion-body">
															<ul class="list-unstyled">
																<?php foreach ($menu['proses'] as $proses): ?>
																	<li>
																		<input type="checkbox" id="proses<?= $proses['id_proses'] ?>" name="access[]" value="<?= $proses['id_proses'] ?>">
																		<label for="proses<?= $proses['id_proses'] ?>"><?= $proses['nama_proses'] ?></label>
																	</li>
																<?php endforeach; ?>
															</ul>
														</div>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> Tutup</button>
				<button type="button" class="btn btn-primary btn-sm"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
			</div>
		</div>
	</div>
</div> -->

<script>
	$(document).ready(function() {
		$('#list').DataTable({
			"bLengthChange" 	: false
		});
	});

	function toaccess(a,b) {
		// $('#tambah_akses').modal('show');
		window.location.href = "<?=base_url('admin_page/berikan_akses/');?>"+a+"/"+b;
	}

	/*function toaccess(a,b) {
		var showLoading = function() {
			Swal.fire({
				title 		: 'Mohon Tunggu!',
				html 		: 'Sedang Mencari Data ...',
				allowOutsideClick 	: false,
				showConfirmButton 	: false,
				willOpen: () => {
					Swal.showLoading()
				},
			});
		}
		showLoading();

		$('#list_menu tbody tr').remove();
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('aksesibilitas/get_akses_menu_per_user');?>',
			dataType: 'JSON',
			data 	: {id : a},
			success : function(data) {
				var table 	= '';
				var no 		= 0;
				for (var a = 0; a < data.length; a++) {
					no++;
					if(data[a].check != 'nol') {var check='checked';} else {var check='';}
					table 	+= '<tr><td style="text-align: center;">'+no+'</td><td>'+data[a].nama_menu+'</td><td><div class="checkbox-inline"><center><input class="form-check-input" type="checkbox" value="'+data[a].id_akses_menu+'" id="check_menu" '+check+'></center></div></td></tr>'
				}
				$('#list_menu tbody:last-child').append(table);
			}
		});

		$('#list_dashboard tbody tr').remove();
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('aksesibilitas/get_akses_dashboard_per_user');?>',
			dataType: 'JSON',
			data 	: {id : a},
			success : function(data) {
				var table 	= '';
				var no 		= 0;
				for (var a = 0; a < data.length; a++) {
					no++;
					if(data[a].check != 'nol') {var check='checked';} else {var check='';}
					table 	+= '<tr><td style="text-align: center;">'+no+'</td><td>'+data[a].nama_menu+'</td><td><div class="checkbox-inline"><center><input class="form-check-input" type="checkbox" value="'+data[a].id_akses_menu+'" id="check_menu" '+check+'></center></div></td></tr>'
				}
				$('#list_dashboard tbody:last-child').append(table);
			}
		});

		$('#list_sidemenu tbody tr').remove();
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url('aksesibilitas/get_akses_sidemenu_per_user');?>',
			dataType: 'JSON',
			data 	: {id : a},
			success : function(data) {
				Swal.close();
				$('#tambah_akses').modal('show');
				$('#tambah_akses').on('shown.bs.modal', function(e){
					$('#exampleModalLabel').html('Berikan Akses Untuk '+b);
				});
				var table 	= '';
				var no 		= 0;
				for (var a = 0; a < data.length; a++) {
					no++;
					if(data[a].check != 'nol') {var check='checked';} else {var check='';}
					table 	+= '<tr><td style="text-align: center;">'+no+'</td><td>'+data[a].nama_sidemenu+'</td><td><div class="checkbox-inline"><center><input class="form-check-input" type="checkbox" value="'+data[a].id_akses_sidemenu+'" id="check_menu" '+check+'></center></div></td></tr>'
				}
				$('#list_sidemenu tbody:last-child').append(table);
			}
		});
	}*/
</script>