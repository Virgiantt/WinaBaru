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
		<button type="button" class="btn btn-dark btn-sm mb-3" onclick="go_back();"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</button>
		<div class="row">
			<div class="col-lg-3 col-sm-12">
				<div class="card shadow">
					<div class="card-header bg-new text-white">
						List Main Page
					</div>
					<div class="card-body">
						<div class="accordion accordion-flush" id="list_main_page">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-sm-12">
				<div class="card shadow">
					<div class="card-header bg-new text-white">
						List Menu
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover table-sm table-bordered" id="list">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Menu</th>
									<th>Icon Menu</th>
									<th>Url Menu</th>
									<th>Urutan Menu</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="card-footer">
						<div id="opt_button">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
	$(document).ready(function() {
		get_main_page();
	});

	function get_main_page() {
		$.ajax({
			type: 'POST',
			url: '<?=base_url('admin_page/get_list_main_page_by_edit_menu')?>',
			dataType: 'JSON',
			success: function(data) {
				var list = "";
				for (var a = 0; a < data.length; a++) {
					var id = data[a].id_main_page;
					var uniqueBodyId = "list_prefix_" + id;

					list += `
					<div class="accordion-item">
					<h2 class="accordion-header" id="flush-` + a + `">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse` + a + `" aria-expanded="false" aria-controls="flush-collapse` + a + `">
					` + data[a].nama_main_page + `
					</button>
					</h2>
					<div id="flush-collapse` + a + `" class="accordion-collapse collapse" aria-labelledby="flush-` + a + `" data-bs-parent="#list_main_page">
					<div class="accordion-body" id="` + uniqueBodyId + `">
					Loading...
					</div>
					</div>
					</div>
					`;

					get_list_menu_by_id_main_page(id, uniqueBodyId);
				}
				$('#list_main_page').html(list);
			}
		});
	}

	function get_list_menu_by_id_main_page(id, targetId) {
		$.ajax({
			type: 'POST',
			url: '<?=base_url('admin_page/get_list_menu_by_id_main_page')?>',
			dataType: 'JSON',
			data: { id: id },
			success: function(data) {
				var list = '';
				if (data.length === 0) {
					list = "Tidak Ada Data";
				} else {
					list = `<div class="list-group">`;
					for (var a = 0; a < data.length; a++) {
						list += `<button type="button" class="list-group-item list-group-item-action" onclick="pick_menu(this, '` + data[a].prefix_menu + `',`+id+`);">` + data[a].prefix_menu + `</button>`;
					}
					list += '</div>';
				}
				$('#' + targetId).html(list);
			}
		});
	}

	function pick_menu(element, id, main_page) {
		$(element).closest('.list-group').find('.list-group-item').removeClass('active');

		$(element).addClass('active');

		get_list_menu(id, main_page);
	}

	function get_list_menu(id, main_page) {
		$.ajax({
			type 	: 'POST',
			url		: '<?=base_url('admin_page/get_list_menu_by_prefix')?>',
			dataType: 'JSON',
			data 	: {prefix : id, id : main_page},
			success : function(data) {
				var tableContent = '';
				if (data.length === 0) {
					tableContent = '<tr><td colspan="6">Tidak Ada Data!</td></tr>';
					$('#exp_exl').attr('disabled', true);
					$('#exp_pdf').attr('disabled', true);
				} else {
					data.forEach(function(item, index) {
						tableContent += `
						<tr data-originalnourut="${item.urutan_menu}">
						<td>${index + 1}</td>
						<td>${item.nama_menu}</td>
						<td><i class="${item.icon_menu}"></i></td>
						<td>${item.url_menu}</td>
						<td>${item.urutan_menu}</td>
						<td id="ic_sort"><i class="fa-solid fa-sort"></i></td>
						</tr>`;
					});
					$('#exp_exl').attr('disabled', false);
					$('#exp_pdf').attr('disabled', false);
				}
				$('#list tbody').html(tableContent);
				get_button();
				$('#btn_save').hide();
				$('#btn_cancel').hide();
			}
		});
	}

	let isChanged = false;
	let initialOrder = [];

	function get_button() {
		var data_table = $('#list tbody tr');
		if (data_table.length <= 1) {
			$('#opt_button').html('<button type="button" id="btn_sort" class="btn btn-danger btn-sm" onclick="sort_data();" disabled><i class="fa-solid fa-sort"></i> Urutkan</button>');
		} else {
			$('#opt_button').html(`
				<button type="button" id="btn_sort" class="btn btn-danger btn-sm" onclick="sort_data();"><i class="fa-solid fa-sort"></i> Urutkan</button>
				<button type="button" id="btn_save" class="btn btn-success btn-sm me-3" onclick="save_data();" style="display: none;" disabled><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
				<button type="button" id="btn_cancel" class="btn btn-danger btn-sm" onclick="cancel_data();" style="display: none;"><i class="fa-regular fa-circle-xmark"></i> Batalkan</button>
				`);
			storeInitialOrder();
		}
	}

	function storeInitialOrder() {
		initialOrder = [];
		$('#list tbody tr').each(function() {
			initialOrder.push($(this).find('td').first().text());
		});
	}

	function sort_data() {
		$('#unit, #cater, #cari').attr('disabled', true);
		$('#btn_sort').hide();
		$('#btn_save').show();
		$('#btn_cancel').show();
		initializeSortable();
	}

	function initializeSortable() {
		$('#list tbody').sortable({
			axis: 'y',
			update: function(event, ui) {
				isChanged = true;
				$('#btn_save').prop('disabled', false);

				$('#list tbody tr').each(function(index) {
					$(this).find('td').first().text(index + 1);
				});
			}
		});
	}

	function save_data() {
		if (!isChanged) return;
		isChanged = false;
		$('#btn_save').prop('disabled', true);
		$('#list tbody').sortable("destroy");

		var logData = [];
		$('#list tbody tr').each(function(index) {
			var main_page = $(this).find('td').eq(1).text();
			var oldNoUrut = $(this).data('originalnourut');
			var newNoUrut = index + 1;

			if (oldNoUrut !== newNoUrut) {
				logData.push({
					nama_menu: main_page,
					no_urut_lama: oldNoUrut,
					no_urut_baru: newNoUrut,
					perubah: '<?= $_SESSION["id_pegawai"] ?>',
					timemade: new Date().toISOString()
				});
			}
		});
		console.log(logData);

		$.ajax({
			type: 'POST',
			url: '<?= base_url("admin_page/simpan_urutan_menu_by_edit") ?>',
			contentType: 'application/json',
			data: JSON.stringify({
				updatedOrder: $('#list tbody tr').map(function(index) {
					return {
						main_page: $(this).find('td').eq(1).text(),
						no_urut: index + 1
					};
				}).get(),
				logData: logData
			}),
			dataType: 'JSON',
			success: function(response) {
				Swal.fire({
					icon: "success",
					title: "Data saved!",
					text: "Changes have been saved successfully."
				});

				$('#list tbody tr').each(function(index) {
					$(this).find('td').eq(4).text(index + 1);
					$(this).data('originalNoUrut', index + 1);
				});

				reset_form();
			}
		});
	}

	function cancel_data() {
		if (isChanged) {
			Swal.fire({
				icon: "warning",
				title: "Batalkan?",
				text: "Anda Sudah Membuat Perubahan Urutan Menu.. Batalkan?",
				showCancelButton: true,
				confirmButtonText: "Ya, Buang Perubahan",
				cancelButtonText: "Tidak"
			}).then((result) => {
				if (result.isConfirmed) {
					isChanged = false;
					$('#btn_save').prop('disabled', true);
					reset_sorting();
					reset_form();
				}
			});
		} else {
			reset_sorting();
			reset_form();
		}
	}

	function reset_sorting() {
		$('#list tbody').sortable("cancel");
		$('#list tbody').sortable("destroy");

		$('#list tbody tr').each(function(index) {
			$(this).find('td').first().text(initialOrder[index]);
		});
	}

	function reset_form() {
		$('#btn_sort').show();
		$('#btn_save, #btn_cancel').hide();
	}

	function go_back() {
		window.location.href = "<?=base_url('admin_page/menu');?>";
	}
</script>