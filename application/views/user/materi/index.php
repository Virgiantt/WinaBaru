
<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/topbar'); ?>

<div class="container">
    <ol class="breadcrumb bg-light mt-3 mb-3">
        <li class="breadcrumb-item"><a href="<?= base_url('Welcome/index') ?>">Home</a></li>
        <li class="breadcrumb-item">Kelas</a></li>
        <li class="breadcrumb-item">Pelatihan</a></li>
        <li class="breadcrumb-item text-dark">Materi</li>
    </ol>

    <div>
        <h1 class="h3 text-gray-800">Materi Pelatihan</h1>
        <p>Pelajari materi terbaru dan tingkatkan keterampilanmu.</p>
    </div>

    <div class="row mt-4" id="materiContainer"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url('Materi/get_materi') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let cardData = "";
                $.each(data, function(index, item) {
                    cardData += `<div class="col-md-4 col-sm-6">
                        <a href="<?= base_url('pembahasan/index') ?>/${item.chapter_id}" class="text-decoration-none">
                            <div class="bg-warning p-4 my-3 text-white rounded shadow" style="min-height: 160px;">
                                <h3>${item.chapter_name}</h3>
                                <p>${item.desc}</p>
                                <small class="text-light">Modul: ${item.modul_name}</small>
                            </div>
                        </a>
                    </div>`;
                });
                $("#materiContainer").html(cardData);
            },
            error: function(xhr, status, error) {
                console.error("Gagal mengambil data:", error);
            }
        });
    });
</script>


<?php $this->load->view('template/footer'); ?>