<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/topbar'); ?>

<div class="container">
    <ol class="breadcrumb bg-light mt-3 mb-3">
        <li class="breadcrumb-item"><a href="<?= base_url('Welcome/index') ?>">Home</a></li>
        <li class="breadcrumb-item">Kelas</a></li>
        <li class="breadcrumb-item text-dark">Pelatihan</li>
    </ol>

    <div>
        <h1 class="h3 text-gray-800">Pelatihan Try Out</h1>
        <p>Latih kemampuanmu dengan materi terbaru dan jadilah yang terdepan di antara teman-temanmu.</p>
    </div>

    <div class="row mt-4" id="pelatihanContainer"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url('Pelatihan/get_pelatihan') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let cardData = "";
                $.each(data, function(index, item) {
                    cardData += `<div class="col-md-4 col-sm-6">
                        <a href="<?= base_url('modul/index') ?>/${item.id}" class="text-decoration-none">
                            <div class="bg-warning p-4 my-3 text-white rounded shadow" style="min-height: 160px; cursor: pointer;">
                                <h3>${item.name}</h3>
                                <p>${item.desc}</p>
                            </div>
                        </a>
                    </div>`;
                });
                $("#pelatihanContainer").html(cardData);
            },
            error: function(xhr, status, error) {
                console.error("Gagal mengambil data:", error);
            }
        });
    });
</script>

<?php $this->load->view('template/footer'); ?>