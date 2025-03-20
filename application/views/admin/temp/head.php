<div class="bg-primary fixed-top" style="width: 100%;
	height: 56px;
	border-bottom: none;">
	<div class="container-fluid">
		<div class="ltoggle">
			<button class="navbar-toggler me-2 tooggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
				<span class="navbar-toggler-icon" data-bs-target="#offcanvasExample">
					<i class="fa-solid fa-bars text-white"></i>
				</span>
			</button>
			<div>
				<img src="<?=base_url('assets/');?>img/images/logo.png" alt="" hegiht="50px" class="logo">
			</div>
			<div class="fw-bold text-uppercase me-auto brand">
				<a href="<?=base_url('main_page');?>" style="color: white; text-decoration: none;">Winayalaksa.id</a>
			</div>
		</div>
		<div class="rtoggle">
			<ul class="navbar-nav mb-2 mb-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle mnu" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa-solid fa-user mnu"></i>
					</a>
					<ul class="mnu dropdown-menu dropdown-menu-end">
						<li>
							<a class="dropdown-item" href="<?=base_url('main_page/ganti_password');?>"><i class="fa-solid fa-user-lock"></i> Ganti Password</a>
						</li>
						<li><a class="dropdown-item" href="<?=base_url('main_page/profil');?>"><i class="fa-solid fa-user"></i> Profil</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item text-danger" href="<?=base_url('auth/logout');?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
<style type="text/css">
	.table-responsive {
		overflow-x: auto !important;
		display: block;
		white-space: nowrap;
	}
</style>