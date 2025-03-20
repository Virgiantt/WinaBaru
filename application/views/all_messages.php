<style>
	.list-group.list-group-flush {
    max-height: 400px; /* Adjust as needed */
    overflow-y: auto;
}
</style>
<main class="container-fluid mt-5">
	<div class="row pt-4">
		<div class="col-lg-3 col-ms-4 col-sm-12">
			<div class="card shadow">
			    <div class="card-header bg-primary text-white">
			        Perpesanan
			        <div class="float-end" id="check_all" style="cursor: pointer;">
			            <i>Pilih Semua</i>
			        </div>
			    </div>
			    <div class="list-group list-group-flush">
			        <div class="d-flex align-items-center justify-content-between px-3 py-2">
			            <div class="form-check">
			                <input class="form-check-input message-checkbox" type="checkbox">
			            </div>
			            <button type="button" class="list-group-item list-group-item-action flex-grow-1 border-0" onclick="show_message('AAAA');">
			                Nama Pegawai
			            </button>
			            <span class="badge bg-success message-badge">4</span>
			        </div>
			        <div class="d-flex align-items-center justify-content-between px-3 py-2">
			            <div class="form-check">
			                <input class="form-check-input message-checkbox" type="checkbox">
			            </div>
			            <button type="button" class="list-group-item list-group-item-action flex-grow-1 border-0" onclick="show_message('BBBB');">
			                Nama Pegawai
			            </button>
			            <span class="badge bg-success message-badge">0</span>
			        </div>
			        <div class="d-flex align-items-center justify-content-between px-3 py-2">
			            <div class="form-check">
			                <input class="form-check-input message-checkbox" type="checkbox">
			            </div>
			            <button type="button" class="list-group-item list-group-item-action flex-grow-1 border-0" onclick="show_message('BBBB');">
			                Nama Pegawai
			            </button>
			            <span class="badge bg-success message-badge">0</span>
			        </div>
			        <div class="d-flex align-items-center justify-content-between px-3 py-2">
			            <div class="form-check">
			                <input class="form-check-input message-checkbox" type="checkbox">
			            </div>
			            <button type="button" class="list-group-item list-group-item-action flex-grow-1 border-0" onclick="show_message('BBBB');">
			                Nama Pegawai
			            </button>
			            <span class="badge bg-success message-badge">0</span>
			        </div>
			        <div class="d-flex align-items-center justify-content-between px-3 py-2">
			            <div class="form-check">
			                <input class="form-check-input message-checkbox" type="checkbox">
			            </div>
			            <button type="button" class="list-group-item list-group-item-action flex-grow-1 border-0" onclick="show_message('BBBB');">
			                Nama Pegawai
			            </button>
			            <span class="badge bg-success message-badge">0</span>
			        </div>
			        <div class="d-flex align-items-center justify-content-between px-3 py-2">
			            <div class="form-check">
			                <input class="form-check-input message-checkbox" type="checkbox">
			            </div>
			            <button type="button" class="list-group-item list-group-item-action flex-grow-1 border-0" onclick="show_message('BBBB');">
			                Nama Pegawai
			            </button>
			            <span class="badge bg-success message-badge">0</span>
			        </div>
			        <div class="d-flex align-items-center justify-content-between px-3 py-2">
			            <div class="form-check">
			                <input class="form-check-input message-checkbox" type="checkbox">
			            </div>
			            <button type="button" class="list-group-item list-group-item-action flex-grow-1 border-0" onclick="show_message('BBBB');">
			                Nama Pegawai
			            </button>
			            <span class="badge bg-success message-badge">0</span>
			        </div>
			        <div class="d-flex align-items-center justify-content-between px-3 py-2">
			            <div class="form-check">
			                <input class="form-check-input message-checkbox" type="checkbox">
			            </div>
			            <button type="button" class="list-group-item list-group-item-action flex-grow-1 border-0" onclick="show_message('BBBB');">
			                Nama Pegawai
			            </button>
			            <span class="badge bg-success message-badge">0</span>
			        </div>
			        <div class="d-flex align-items-center justify-content-between px-3 py-2">
			            <div class="form-check">
			                <input class="form-check-input message-checkbox" type="checkbox">
			            </div>
			            <button type="button" class="list-group-item list-group-item-action flex-grow-1 border-0" onclick="show_message('BBBB');">
			                Nama Pegawai
			            </button>
			            <span class="badge bg-success message-badge">0</span>
			        </div>
			    </div>
			    <div class="card-footer">
			        <div class="d-grid gap-2">
			            <button type="button" class="btn btn-info btn-sm" id="flag_read" disabled>Tandai Sudah Dibaca</button>
			            <button type="button" class="btn btn-warning btn-sm" id="hapus_checked" disabled>Hapus yang Ditandai</button>
			            <button type="button" class="btn btn-danger btn-sm">Hapus Semua Pesan</button>
			        </div>
			    </div>
			</div>
		</div>
		<div class="col-lg-9 col-md-8 col-sm-12">
			<div class="card shadow" id="gets_message">
				<div class="card-body" style="height: 500px;">
					<div id="view_message">
					</div>
				</div>
				<div class="card-footer">
					<div class="input-group">
						<input type="text" class="form-control form-control-sm" placeholder="Ketik Pesan Disini ..." aria-label="Recipient's username" aria-describedby="button-addon2">
						<button class="btn btn-primary btn-sm" type="button" id="button-addon2">Kirim</button>
					</div>
				</div>
			</div>
			<div id="view_message">
				
			</div>
		</div>
	</div>
</main>

<script>
	$(document).ready(function () {
		$('#gets_message').hide();
	    $("#check_all").click(function () {
	        let isChecked = $(".message-checkbox").prop("checked");
	        $(".message-checkbox").prop("checked", !isChecked);
	        updateButtons();
	    });

	    $(".message-checkbox").change(function () {
	        updateButtons();
	    });

	    function updateButtons() {
	        let anyChecked = $(".message-checkbox:checked").length > 0;
	        let anyUnreadChecked = $(".message-checkbox:checked").closest(".d-flex").find(".message-badge").filter(function() {
	            return $(this).text().trim() !== "0";
	        }).length > 0;

	        $("#hapus_checked").prop("disabled", !anyChecked);
	        $("#flag_read").prop("disabled", !anyUnreadChecked);
	    }
	});

	function show_message(id) {
		$('#gets_message').show();
		$('#view_message').html(id);
	}
</script>
