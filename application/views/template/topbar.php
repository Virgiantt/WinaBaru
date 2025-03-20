<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid">
		<a class="navbar-brand d-flex align-items-center" href="<?=base_url('main_page');?>">
			<img src="<?=base_url('assets/');?>img/images/logo.png" alt="Logo" height="30" class="me-2">
			<span class="fw-bold brand-text">Winayalaksa.id</span>
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
			</ul>
			<div class="d-flex ms-auto">
				<ul class="navbar-nav">
					<!-- User Profile -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fa-regular fa-user"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
							<li><a class="dropdown-item" href="<?=base_url('main_page/profil');?>"><i class="fa-regular fa-user me-2"></i> Profil</a></li>
							<li><a class="dropdown-item" href="<?=base_url('main_page/ganti_password');?>"><i class="fa-solid fa-user-lock me-2"></i> Ganti Password</a></li>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item text-danger" href="<?=base_url('auth/logout');?>"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a></li>
						</ul>
					</li>

				</ul>
			</div>
		</div>
	</div>
</nav>
