<div class="container">

   <h1 class="h3 text-gray-800">Bimbingan Belajar CPNS & Sekolah Kedinasan Winaya Laksa</h1>
   <h5 class="text-dark">Selesaikan try out untuk melatih kemampuan kamu.</h5>

   <?php
   $role = isset($role) ? $role : null;

   if ($role === '1'):
   ?>
      <?php if ($announcement->status == 1): ?>
         <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Pengumuman</h4>
            <p><?= $announcement->text ?> </p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
         </div>
      <?php endif ?>

      <div class="row" style="margin-bottom:250px">
         <?php foreach ($main_page as $menu): ?>
            <a href="<?= base_url($menu->link) ?>" class="col-md-4 col-sm-6 text-decoration-none">
               <div class="bg-warning p-4 my-3 text-white rounded shadow" style="min-height: 160px;">
                  <h3><?= $menu->name ?></h3>
                  <p><?= $menu->desc ?></p>
               </div>
            </a>
         <?php endforeach; ?>
      </div>

   <?php elseif ($role == 2): ?>

      <ol class="breadcrumb bg-light mt-4">
         <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
      </ol>

      <div class="row" style="margin-bottom:250px">
         <!-- 3 di atas -->
         <div class="col-md-4 col-sm-6">
            <a href="<?= base_url("DashboardMember/soal") ?>" class="text-decoration-none">
               <div class="bg-warning p-4 my-3 text-white rounded shadow" style="min-height: 160px;">
                  <h3>Try Out</h3>
                  <p>Uji kesiapanmu dengan tryout kami, tantang dirimu untuk menjadi yang terbaik di antara yang lain!</p>
               </div>
            </a>
         </div>

         <div class="col-md-4 col-sm-6">
            <a href="<?= base_url("user/kelas/index") ?>" class="text-decoration-none">
               <div class="bg-warning p-4 my-3 text-white rounded shadow" style="min-height: 160px;">
                  <h3>E - Learning</h3>
                  <p>Belajarlah Dengan Giat.</p>
               </div>
            </a>
         </div>

         <div class="col-md-4 col-sm-6">
            <a href="<?= base_url("DashboardMember/hasil") ?>" class="text-decoration-none">
               <div class="bg-warning p-4 my-3 text-white rounded shadow" style="min-height: 160px;">
                  <h3>Hasil</h3>
                  <p>Lihat hasil upayamu! Bandingkan dan analisis performamu dengan pengguna lain.</p>
               </div>
            </a>
         </div>

         <div class="col-md-4 col-sm-6">
            <div data-toggle="modal" data-target="#detailModal" class="text-decoration-none">
               <div class="bg-warning p-4 my-3 text-white rounded shadow" style="min-height: 160px; cursor: pointer;">
                  <h3>Pengumuman</h3>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title text-dark">Pengumuman</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body text-dark">
                  <h5 style="line-height: 30px;"></h5>
               </div>
            </div>
         </div>
      </div>

   <?php else: ?>
      <div class="alert alert-danger">
         <strong>Error!</strong> Role tidak dikenali.
      </div>
   <?php endif; ?>

</div>