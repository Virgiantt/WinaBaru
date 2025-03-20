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
				<li class="my-1">
					<hr class="dropdown-divider">
				</li>
				<li>
					<div class="small fw-bold text-uppercase px-3" style="color: #8f8f8f;">Kembali</div>
				</li>
				<li>
					<a href="<?=base_url('main_page');?>" class="nav-link px-3">
						<span class="me-2">
							<i class="fa-solid fa-arrow-left"></i>
						</span>
						Menu Utama
					</a>
				</li>
				<li class="my-1">
					<hr class="dropdown-divider">
				</li>
				<li>
					<div class="small fw-bold text-uppercase px-3" style="color: #8f8f8f;">Menu</div>
				</li>
				<li>
					<a href="<?=base_url('admin_page');?>" class="nav-link px-3">
						<span class="me-2">
							<i class="fa-solid fa-gears"></i>
						</span>
						Dashboard
					</a>
				</li>
				<?php $no = 1; ?>
				<?php $np = 1; ?>
				<?php
				?>
				<?php
				$jabatan 	= $this->session->userdata('id_jabatan');
				$id 		= 1;
				$query 	= "SELECT prefix_menu,count(id_menu) as jumlah FROM tbl_menu WHERE id_main_page='$id' GROUP BY prefix_menu ORDER BY id_menu";
				$data 	= $this->db->query($query)->result_array();
				foreach ($data as $dt) {
					if($dt['jumlah'] == "1") { 
						$pre 	= $dt['prefix_menu'];
						$query1 = "SELECT tbl_akses_menu.id_jabatan, tbl_akses_menu.id_menu, tbl_menu.id_main_page, tbl_menu.nama_menu, tbl_menu.icon_menu, tbl_menu.url_menu, tbl_menu.urutan_menu, tbl_menu.prefix_menu FROM tbl_akses_menu INNER JOIN tbl_menu ON tbl_akses_menu.id_menu = tbl_menu.id_menu WHERE tbl_menu.id_main_page = '$id' AND tbl_akses_menu.id_jabatan='$jabatan' AND tbl_menu.prefix_menu = '$pre'";
						$data1 	= $this->db->query($query1)->result_array();
						foreach ($data1 as $dt1) : ?>
							<li>
								<a href="<?=base_url($dt1['url_menu']);?>" class="nav-link px-3">
									<span class="me-2">
										<i class="<?=$dt1['icon_menu'];?>"></i>
									</span>
									<?=$dt1['nama_menu'];?>
								</a>
							</li>
						<?php endforeach; ?>
					<?php } else { ?>
						<li>
							<a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseExample<?=$no++;?>" role="button" aria-expanded="false" aria-controls="collapseExample">
								<span class="me-2">
									<i class="fa-solid fa-list"></i>
								</span>
								<?=$dt['prefix_menu'];?>
								<span class="ms-auto"></span>
								<span class="right-icon ms-auto"><i class="fa-solid fa-chevron-left"></i></span>
							</a>
							<div class="collapse" id="collapseExample<?=$np++;?>">
								<div>
									<ul class="navbar-nav ps-3">
										<?php
										$pre 	= $dt['prefix_menu'];
										$query2 = "SELECT tbl_akses_menu.id_jabatan, tbl_akses_menu.id_menu, tbl_menu.id_main_page, tbl_menu.nama_menu, tbl_menu.icon_menu, tbl_menu.url_menu, tbl_menu.urutan_menu, tbl_menu.prefix_menu FROM tbl_akses_menu INNER JOIN tbl_menu ON tbl_akses_menu.id_menu = tbl_menu.id_menu WHERE tbl_menu.id_main_page = '$id' AND tbl_akses_menu.id_jabatan='$jabatan' AND tbl_menu.prefix_menu = '$pre'";
										$data2 	= $this->db->query($query2)->result_array();
										foreach ($data2 as $dt2) : ?>

											<li>
												<a href="<?=base_url($dt2['url_menu']);?>" class="nav-link px-3">
													<span class="me-2">
														<i class="<?=$dt2['icon_menu'];?>"></i>
													</span>
													<?=$dt2['nama_menu'];?>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</li>
					<?php }
				} ?>
			</ul>
			<br>
			<br>
		</nav>
	</div>
</div>