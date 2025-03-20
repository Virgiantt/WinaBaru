<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?= $pages ?></h3>
		<hr>
		<div class="card border-primary">
			<div class="card-header bg-primary text-white">
				Semua Pegawai Non-aktif
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover table-sm table-bordered" id="list">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Pegawai</th>
							<th>Username</th>
							<th>Password 1</th>
							<th>Password 2</th>
							<th>Aktif</th>
							<th>visible</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no 	= 1;
						foreach ($list as $ls) : ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $ls->nama; ?></td>
								<td><?= $ls->username; ?></td>
								<td><?php if ($ls->password == "") {
										echo 'Tidak Ada';
									} else {
										echo 'Ada';
									} ?></td>
								<td><?php if ($ls->password2 == "") {
										echo 'Tidak Ada';
									} else {
										echo 'Ada';
									} ?></td>
								<td><?php if ($ls->aktif == '1') {
										echo '<i class="fa-regular fa-circle-check text-success"></i>';
									} else {
										echo '<i class="fa-regular fa-circle-xmark text-danger"></i>';
									} ?></td>
								<td><?php if ($ls->visible == '1') {
										echo '<i class="fa-regular fa-circle-check text-success"></i>';
									} else {
										echo '<i class="fa-regular fa-circle-xmark text-danger"></i>';
									} ?></td>
								<td><button type="button" class="btn btn-success btn-sm" onclick="aktifkan(<?= $ls->id_user; ?>,'<?= $ls->username ?>');"><i class="fa-solid fa-user-shield"></i> Aktifkan</button></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>

<script>
	$(document).ready(function() {
		$('#list').DataTable({
			"bLengthChange": false
		});
	});

	function aktifkan(a, b) {
		Swal.fire({
			title: "Aktifkan?",
			text: "Apakah Anda Yakin Akan Mengaktifkan User Ini!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Ya, Aktifkan!",
			cancelButtonText: "Batal"
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= base_url('aksesibilitas/aktifkan_user'); ?>',
					dataType: 'JSON',
					data: {
						id: a,
						username: b
					},
					success: function(data) {
						Swal.fire({
							title: "Berhasil!",
							text: "Pegawai Berhasil Diaktifkan!",
							icon: "success"
						}).then((result) => {
							location.reload();
						});
					}
				});
			}
		});
	}
</script>