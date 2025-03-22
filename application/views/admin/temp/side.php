<div class="offcanvas offcanvas-start text-white sidebar-nav bg-primary" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
	<div class="offcanvas-body p-0">
		<nav class="navbar-dark">
      <ul class="navbar-nav">
    <!-- Spasi kecil -->
    <li style="height: 10px;"></li>

    <!-- Data Pengguna -->
    <li>
        <div class="container">
            <div class="row">
                <?php
                $username 	= $this->session->userdata('username');
                $query 		= "SELECT * FROM user WHERE username='$username'";
                $data 		= $this->db->query($query)->result_array();
                foreach ($data as $hasil) :
                ?>
                    <div style="width: 75%" class="text-uppercase">
                        <?= $hasil['username']; ?>
                        <i><?= $hasil['name']; ?></i>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </li>

    <!-- Garis Pembatas -->
    <li class="my-1"><hr class="dropdown-divider"></li>

    <!-- Kembali ke Menu Utama -->
    <li>
        <div class="small fw-bold text-uppercase px-3">Kembali</div>
    </li>
    <li>
        <a href="<?= base_url('welcome'); ?>" class="nav-link px-3">
            <span class="me-2"><i class="fa-solid fa-arrow-left"></i></span>
            Menu Utama
        </a>
    </li>

    <!-- Garis Pembatas -->
    <li class="my-1"><hr class="dropdown-divider"></li>

    <!-- Menu Utama -->
    <li>
        <div class="small fw-bold text-uppercase px-3">Menu</div>
    </li>
    <li>
        <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link px-3">
            <span class="me-2"><i class="fa-solid fa-chart-line"></i></span>
            Dashboard
        </a>
    </li>

    <!-- E-Learning (Collapse) -->
    <li class="nav-item">
        <a href="#elearningSubmenu" class="nav-link px-3" data-bs-toggle="collapse">
            <span class="me-2"><i class="fa-solid fa-book-open"></i></span>
            E-Learning
            <i class="fa-solid fa-chevron-down float-end"></i>
        </a>
        <ul class="collapse list-unstyled ps-4" id="elearningSubmenu">
            <li><a href="<?= base_url('admin/learndashboard'); ?>" class="nav-link"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="<?= base_url('admin/learnkelas'); ?>" class="nav-link"><i class="fa-solid fa-users"></i> Kelas</a></li>
            <li><a href="<?= base_url('admin/learnpelatihan'); ?>" class="nav-link"><i class="fa-solid fa-graduation-cap"></i> Pelatihan</a></li>
            <li><a href="<?= base_url('admin/learnmodul'); ?>" class="nav-link"><i class="fa-solid fa-file-alt"></i> Modul</a></li>
            <li><a href="<?= base_url('admin/learnmateri'); ?>" class="nav-link"><i class="fa-solid fa-book"></i> Materi</a></li>
            <li><a href="<?= base_url('admin/aksesmp'); ?>" class="nav-link"><i class="fa-solid fa-clipboard-list"></i> Akses Main Page</a></li>
            <li><a href="<?= base_url('admin/cabang'); ?>" class="nav-link"><i class="fa-solid fa-comments"></i> Cabang & Akses</a></li>
        </ul>
    </li>

    <!-- Pre Test (Collapse) -->
    <li class="nav-item">
        <a href="#pretestSubmenu" class="nav-link px-3" data-bs-toggle="collapse">
            <span class="me-2"><i class="fa-solid fa-pen-to-square"></i></span>
            Pre Test
            <i class="fa-solid fa-chevron-down float-end"></i>
        </a>
        <ul class="collapse list-unstyled ps-4" id="pretestSubmenu">
            <li><a href="<?= base_url('admin/tesdashboard'); ?>" class="nav-link"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="<?= base_url('admin/teskelas'); ?>" class="nav-link"><i class="fa-solid fa-users"></i> Kelas</a></li>
            <li><a href="<?= base_url('admin/teskategori'); ?>" class="nav-link"><i class="fa-solid fa-layer-group"></i> Kategori</a></li>
            <li><a href="<?= base_url('admin/testryout'); ?>" class="nav-link"><i class="fa-solid fa-clock"></i> Tryout</a></li>
            <li><a href="<?= base_url('admin/teslatihan'); ?>" class="nav-link"><i class="fa-solid fa-pencil-alt"></i> Latihan</a></li>
        </ul>
    </li>
</ul>

		</nav>
	</div>
</div>