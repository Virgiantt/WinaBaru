<div class="offcanvas offcanvas-start text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color: #4d555d">
	<div class="offcanvas-body p-0">
		<nav class="navbar-dark">
			<ul class="navbar-nav">
				<li style="height: 10px;"></li>
				<li>
					<div class="container">
						<div class="row">
							<?php
							$pegawai 	= $this->session->userdata('id_pegawai');
							$query 		= "SELECT * FROM tbl_pegawai WHERE id_pegawai='$pegawai'";
							$data 		= $this->db->query($query)->result_array();
							foreach ($data as $hasil ) : 
								if(empty($hasil['foto'])) { $pp = 'nopp.jpg'; } else { $pp = $hasil['foto']; }
								?>
								<div style="width: 25%">
									<img src="<?=base_url('assets/');?>img/pic/<?=$pp;?>" alt="" width="100%" class="circular--portrait">
								</div>
								<div style="width: 75%" class="text-uppercase">

									<?=$hasil['nama_pegawai'];?>
									<i><?=$hasil['nup'];?></i>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</li>
				<li class="my-1"><hr class="dropdown-divider"></li>
				<li><div class="small fw-bold text-uppercase px-3" style="color: #8f8f8f;">Menu</div></li>
				<li>
					<a href="<?=base_url('cari_pelanggan');?>" class="nav-link px-3">
						<span class="me-2">
							<i class="fa-solid fa-users-viewfinder"></i>
						</span>
						Cari Pelanggan
					</a>
				</li>
				<?php
				$no 	= 1;
				$np 	= 1;
				foreach ($main_page as $mp) : ?>
					<li>
						<a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseExample<?=$no++;?>" role="button" aria-expanded="false" aria-controls="collapseExample">
							<span class="me-2">
								<i class="<?=$mp->icon_page;?>"></i>
							</span>
							<?=$mp->nama_page;?>
							<span class="ms-auto"></span>
							<span class="right-icon ms-auto"><i class="fa-solid fa-chevron-left"></i></span>
						</a>
						<div class="collapse" id="collapseExample<?=$np++;?>">
							<ul class="navbar-nav ps-3">
								<?php
								$jabatan 	= $this->session->userdata('id_jabatan');
								$parent 	= $mp->id_main_page;
								$query 		= "SELECT tbl_akses_menu.id_akses_menu, tbl_akses_menu.id_jabatan, tbl_akses_menu.id_menu, tbl_menu.id_main_page, tbl_menu.nama_menu, tbl_menu.icon_menu, tbl_menu.url_menu, tbl_menu.parent_menu, tbl_menu.urutan_menu, tbl_menu.is_proses, tbl_menu.aktif, tbl_menu.visible FROM tbl_akses_menu JOIN tbl_menu ON tbl_akses_menu.id_menu = tbl_menu.id_menu WHERE tbl_menu.id_main_page='$parent' AND tbl_menu.parent_menu='0' AND tbl_menu.is_proses='0' AND tbl_menu.aktif = '1' AND tbl_menu.visible = '1' AND id_jabatan='$jabatan' ORDER BY tbl_menu.urutan_menu ASC";
								$inmenu 	= $this->db->query($query)->result_array();
								foreach($inmenu AS $im) : ?>
									<li>
										<a href="<?=base_url($im['url_menu']);?>" class="nav-link px-4">
											<span class="me-2"><i class="<?=$im['icon_menu'];?>"></i></span>
											<span><?=$im['nama_menu'];?></span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<br>
			<br>
		</nav>
	</div>
</div>