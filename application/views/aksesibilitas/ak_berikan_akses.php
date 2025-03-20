<style>
	.bg-new {
		background: rgb(0,17,87);
		background: linear-gradient(29deg, rgba(0,17,87,1) 0%, rgba(2,175,209,1) 95%, rgba(0,209,255,1) 100%);
	}
	.btn-new {
		background-color: #070074;
	}
</style>
<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
		<hr>
		<div class="row">
			<div class="col">
				<div class="card shadow">
					<div class="card-header bg-new text-white">
						Main Page
					</div>
					<div class="card-body">
						<?php
						$this->load->model('Aksesiblitas_model', 'a_model');
						$id_jabatan = $this->uri->segment(3);
						$no = 1;
						$mainPageData = $this->a_model->get_list_all_main_page($id_jabatan);
						?>
						<table class="table" id="mainPageTable">
							<thead>
								<tr>
									<th>No</th>
									<th>Main Page Name</th>
									<th>URL</th>
									<th>Access</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($mainPageData as $mainPage): ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= htmlspecialchars($mainPage->nama_main_page) ?></td>
										<td><?= htmlspecialchars($mainPage->url_main_page) ?></td>
										<td>
											<input type="checkbox" 
											name="access[]" 
											value="<?= htmlspecialchars($mainPage->id_main_page) ?>" 
											<?= $mainPage->has_access ? 'checked' : '' ?>
											class="access-checkbox">
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<div class="card-footer">
						<button id="saveButton" type="button" class="btn btn-new text-white btn-sm" onclick="mod_main_page();" disabled>
							<i class="fa-regular fa-floppy-disk"></i> Simpan
						</button>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card shadow">
					<div class="card-header bg-new text-white">
						Menu
					</div>
					<div class="card-body">
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card shadow">
					<div class="card-header bg-new text-white">
						Proses
					</div>
					<div class="card-body">
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
	$(document).ready(function() {
		let initialStates = {};
		$('.access-checkbox').each(function(index) {
			initialStates[index] = $(this).prop('checked');
		});

		$('.access-checkbox').change(function() {
			let isChanged = false;

			$('.access-checkbox').each(function(index) {
				if ($(this).prop('checked') !== initialStates[index]) {
					isChanged = true;
					return false;
				}
			});

			$('#saveButton').prop('disabled', !isChanged);
		});
	});

	function mod_main_page() {
		var id_jabatan = '<?=$this->uri->segment(3)?>';

		var accessData = [];
		$('#mainPageTable .access-checkbox').each(function() {
			accessData.push({
				id_main_page: $(this).val(),
				checked: $(this).prop('checked')
			});
		});
		console.log(accessData);

		$.ajax({
			url: '<?= base_url("admin_page/check_access_main_page") ?>',
			type: 'POST',
			data: {
				id_jabatan: id_jabatan,
				accessData: accessData
			},
			success: function(response) {
				alert(response.message);
				$('#saveButton').prop('disabled', true);
			},
			error: function() {
				alert("An error occurred while saving.");
			}
		});
	}
</script>