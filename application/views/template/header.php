<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Winayalaksa.id</title>
	<link href="<?=base_url('assets/');?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url('assets/');?>css/style.css" rel="stylesheet">
	<link href="<?=base_url('assets/');?>css/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="<?=base_url('assets/');?>css/all.min.css" rel="stylesheet">
	<script src="<?=base_url('assets/');?>js/jquery-3.6.1.js"></script>
	<link href="<?=base_url('assets/');?>css/virtual-select.min.css" rel="stylesheet">
	<link href="<?=base_url('assets/');?>css/tags.css" rel="stylesheet">
	<link href="<?=base_url('assets/');?>css/sweetalert2.min.css" rel="stylesheet">
	<link href="<?=base_url('assets/');?>css/buttons.bootstrap5.css" rel="stylesheet">
	<link href="<?=base_url('assets/');?>css/bootstrap-select.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
	<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
	<style>
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		input[type=number] {
			-moz-appearance: textfield;
		}
		@media (max-width: 576px) {  /* Ukuran untuk smartphone */
			.brand-text {
				font-size: 14px;  /* Ukuran lebih kecil di HP */
			}
		}
		@media (min-width: 768px) {  /* Ukuran untuk tablet ke atas */
			.brand-text {
				font-size: 18px;
			}
		}
		@media (min-width: 992px) {  /* Ukuran untuk layar besar */
			.brand-text {
				font-size: 20px;
			}
		}

	</style>

	<script src="<?=base_url('assets/');?>js/tags.js"></script>
	<script src="<?=base_url('assets/');?>js/autofill.js"></script>
	<!-- <script src="<?=base_url('assets/');?>js/select2.min.js"></script> -->
	<script src="<?=base_url('assets/');?>js/virtual-select.min.js"></script>
	<script src="<?=base_url('assets/');?>js/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<!-- <link rel="stylesheet" href="<?= base_url('assets/');?>leaflet/leaflet.css"/>
		<script src="<?= base_url('assets/');?>leaflet/leaflet.js"></script> -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

		<!--Marquee Title-->
		<script type='text/javascript'>
			msg = "Winayalaksa.id";
			msg = " | Teman Sukses Masa Depanmu! | " + msg;
			pos = 0;

			function scrollMSG() {
				document.title = msg.substring(pos, msg.length) + msg.substring(0, pos);
				pos++;
				if (pos > msg.length) pos = 0
					window.setTimeout("scrollMSG()", 400);
			}
			scrollMSG();
		</script>
		<!--End of Marquee Title-->
		<link rel="icon" type="image/x-icon" href="<?=base_url('assets/');?>img/images/logo.png">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.js" integrity="sha512-7uomMJLUlyzgg7Cu8C57a3XB/JX2fLV1mWES4FpvJm4QgC2WDsBDDeFfOQkGpCfZFjNLhBqsXavmRQGs8X1SBw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	</head>
	<body>