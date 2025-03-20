<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Login</title>
	<link href="<?=base_url('assets/');?>css/bootstrap.min.css" rel="stylesheet">
	<script src="<?=base_url('assets/');?>js/jquery-3.6.1.js"></script>
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
	<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/images/logo.png'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">

    <style>
        .h-custom {
            height: 100vh;
        }
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>
<body>
    <section class="h-custom d-flex align-items-center justify-content-center bg-warning">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card shadow-lg p-4 border-0 rounded-4">
                        <div class="card-body text-center">
                            <img src="<?= base_url('assets/img/images/logo.png'); ?>" width="120px" class="mb-3" style="filter: drop-shadow(3px 3px 3px #626262);">
                            <h4 class="fw-bold">LOGIN</h4>
                            <?= $this->session->flashdata('message'); ?>

                            <form action="" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Masukkan Username">
                                    <label for="inputUsername">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Masukkan Password">
                                    <label for="inputPassword">Password</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100">Masuk</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="fixed-bottom bg-white text-center py-2 shadow">
        <strong>WINAYALAKSA &copy; 2025</strong>
    </footer>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>

</html>