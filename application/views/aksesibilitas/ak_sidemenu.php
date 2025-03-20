<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
		<hr>
		<div class="card border-primary">
			<div class="card-header bg-primary text-white">
				<div class="float-end">
					<button type="button" id="tambah" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#tambah_menu"><i class="fa-solid fa-circle-plus"></i> Tambah</button>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover table-sm table-bordered" id="list">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Menu</th>
							<th>Nama SideMenu</th>
							<th>Icon Menu</th>
							<th>Url Menu</th>
							<th>Parent Sidemenu</th>
							<th>Urutan Sidemenu</th>
							<th>Aktif</th>
							<th>Visible</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no 	= 1;
						foreach ($m_page as $mp) : ?>
							<tr>
								<td><?=$no++;?></td>
								<td><?=$mp->nama_menu;?></td>
								<td><?=$mp->nama_sidemenu;?></td>
								<td><i class="<?=$mp->icon_sidemenu;?>"></i></td>
								<td><?=$mp->url_sidemenu;?></td>
								<td>
									<?php
									$id 	= $mp->parent_sidemenu;
									$query 	= "SELECT * FROM tbl_sidemenu WHERE id_sidemenu='$id'";
									$data 	= $this->db->query($query)->result_array();
									foreach ($data as $dt) {
										if($dt['nama_sidemenu'] == '0') {
											echo '';
										} else {
											echo $dt['nama_sidemenu'];
										}
									}
									?>
								</td>
								<td><?=$mp->urutan_sidemenu;?></td>
								<td><?php if($mp->aktif == '1') { echo '<i class="fa-regular fa-circle-check text-success"></i>';} else { echo '<i class="fa-regular fa-circle-xmark text-danger"></i>';} ?></td>
								<td><?php if($mp->visible == '1') { echo '<i class="fa-regular fa-circle-check text-success"></i>';} else { echo '<i class="fa-regular fa-circle-xmark text-danger"></i>';} ?></td>
								<td>
									<div class="dropdown">
										<a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
											<i class="fa-solid fa-list-check"></i> Pilih
										</a>

										<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuLink">
											<li><button type="button" class="dropdown-item" onclick="edit();"><i class="fa-regular fa-pen-to-square"></i> Edit</button></li>
											<li><button type="button" class="dropdown-item" onclick="hapus();"><i class="fa-regular fa-trash-can"></i> Hapus</button></li>
										</ul>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>

<div class="modal fade" id="tambah_menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row mb-2">
					<label for="nama_menu" class="col-sm-3 col-form-label">Url Menu</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" id="nama_menu">
					</div>
				</div>
				<div class="row mb-2">
					<label for="url_menu" class="col-sm-3 col-form-label">Nama Menu</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" id="url_menu">
					</div>
				</div>
				<div class="row mb-2">
					<label for="url_menu" class="col-sm-3 col-form-label">Gambar Menu</label>
					<div class="col-sm-9">
						<input class="form-control form-control-sm" id="gambar_menu" type="file">
					</div>
				</div>
				<div class="row mb-2">
					<label for="urutan_menu" class="col-sm-3 col-form-label">Urutan Menu</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" id="urutan_menu">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#list').DataTable({
			"bLengthChange" 	: false
		});
	});
</script>