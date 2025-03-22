<div class="container">

    <h1 class="h3 text-gray-800">Bimbingan Belajar CPNS & Sekolah Kedinasan Winaya Laksa</h1>
    <h5 class="text-dark">Selesaikan try out untuk melatih kemampuan kamu.</h5>

   <?php if ($announcement->status == 1): ?>
   <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Pengumuman</h4>
      <p><?= $announcement->text ?> </p>
      <hr>
      <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
   </div>
   <?php endif ?>

    <div class="row" style="margin-bottom:250px">
      <?php
         foreach ($main_page as $menu) {
      ?>
         <a href="<?= base_url($menu->link) ?>" class="col-sm-4 text-decoration-none">
            <div class="bg-warning p-4 my-3 text-white rounded shadow" style="min-height: 160px;">
               <h3><?= $menu->name ?></h3>
               <p><?= $menu->desc ?></p>
            </div>
         </a>
      <?php
         }
      ?>
    </div>

</div>