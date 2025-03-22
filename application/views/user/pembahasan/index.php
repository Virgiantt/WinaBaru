
<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/topbar'); ?>

<div class="container">
    <ol class="breadcrumb bg-light mt-3 mb-3">
        <li class="breadcrumb-item"><a href="<?= base_url('Welcome/index') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('Materi') ?>">Materi</a></li>
    </ol>

    <h1 class="h3"><?= isset($materi->name) ? $materi->name : 'Judul Tidak Ditemukan' ?></h1>
    <p><?= isset($materi->desc) ? $materi->desc : 'Deskripsi tidak tersedia' ?></p>

    <div class="card mb-3 border-0 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <strong><i class="fas fa-book"></i> Pembahasan</strong>
        </div>
        <div class="card-body" style="min-height: 350px;">
            <p>Berikut materi pembahasan yang dapat dipelajari secara mandiri.</p>
            <ul class="list-group" id="pembahasan-list">
                <li class="list-group-item text-center">Memuat data...</li>
            </ul>
        </div>
    </div>

    <div class="card mb-3 border-0 shadow-sm">
        <div class="card-header bg-danger text-white d-flex justify-content-between">
            <strong><i class="fas fa-question-circle"></i> Soal Pre-Test</strong>
        </div>
        <div class="card-body" style="min-height: 350px;">
            <p>Sebelum mengerjakan, silakan perhatikan informasi berikut.</p>
            <ul class="list-group" id="soal-list">
                <li class="list-group-item text-center">Memuat data...</li>
            </ul>
            <div class="text-center mt-3">
                <a href="#" id="kerjakan-soal" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Kerjakan</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var chapterId = <?= isset($materi->id) ? $materi->id : 'null' ?>;

        function loadPembahasan() {
            $.ajax({
                url: "<?= base_url('Pembahasan/getPembahasan/') ?>" + chapterId,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    var list = $("#pembahasan-list");
                    list.empty();

                    if (data.length > 0) {
                        var content = '<div class="row">';

                        data.forEach(function(item) {
                            var youtubeId = getYoutubeId(item.link);
                            var thumbnail = youtubeId ? `
                                <a href="${item.link}" target="_blank" class="d-block">
                                    <img src="https://img.youtube.com/vi/${youtubeId}/hqdefault.jpg" class="card-img-top" style="height: 150px; object-fit: cover;">
                                </a>` : '';
                            var fileDownload = item.filepath ? `
                                <a href="<?= base_url() ?>${item.filepath}" target="_blank" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-download"></i> Download
                                </a>` : '';

                            content += `<div class="col-md-4 mb-3">
                                <div class="card shadow-sm bg-white" style="min-height: 300px;">
                                    ${thumbnail}
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">${item.name ?? 'Tidak ada nama'}</h5>
                                        <p class="card-text flex-grow-1">${item.desc ?? 'Tidak ada deskripsi'}</p>
                                        ${fileDownload}
                                    </div>
                                </div>
                            </div>`;
                        });

                        content += '</div>';
                        list.append(content);
                    } else {
                        list.append('<div class="col-12 text-center text-muted">Tidak ada data pembahasan</div>');
                    }
                }
            });
        }

        function loadSoal() {
            $.ajax({
                url: "<?= base_url('Pembahasan/getSoal/') ?>" + chapterId,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    var list = $("#soal-list");
                    list.empty();
                    if (data.length > 0) {
                        data.forEach(function(item, index) {
                            var listItem = `<li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${index + 1}. ${item.name}</strong>
                            <p class="mb-0">${item.desc}</p>
                        </div>
                        <button class="btn btn-primary btn-sm kerjakan-btn" data-id="${item.id}" data-name="${item.name}">
                            <i class="fas fa-pencil-alt"></i> Kerjakan
                        </button>
                    </li>`;
                            list.append(listItem);
                        });

                        // Tambahkan event listener setelah elemen tombol ditambahkan ke DOM
                        $(".kerjakan-btn").click(function() {
                            var discussId = $(this).data("id");
                            var discussName = $(this).data("name");

                            $.ajax({
                                url: "<?= base_url('Soal/updateDiscussId') ?>",
                                method: "POST",
                                data: {
                                    discuss_id: discussId,
                                    name: discussName
                                },
                                success: function(response) {
                                    window.location.href = "<?= base_url('soal/index/') ?>" + discussId;
                                }
                            });
                        });

                    } else {
                        list.append('<li class="list-group-item text-center">Belum ada soal</li>');
                    }
                }
            });
        }


        function getYoutubeId(url) {
            var match = url.match(/(?:youtube\.com\/(?:[^\/]+\/.*\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
            return match ? match[1] : null;
        }

        if (chapterId !== 'null') {
            loadPembahasan();
            loadSoal();
        }
    });
</script>

<?php $this->load->view('template/footer'); ?>
