<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/topbar'); ?>

<div class="container">
    <ol class="breadcrumb bg-light mt-3 mb-3">
        <li class="breadcrumb-item"><a href="<?= base_url('Welcome/index') ?>">Home</a></li>
        <li class="breadcrumb-item">Kelas</li>
        <li class="breadcrumb-item">Pelatihan</li>
        <li class="breadcrumb-item">Modul</li>
        <li class="breadcrumb-item text-dark">Materi</li>
    </ol>

    <div>
        <h1 class="h3 text-gray-800">Materi Try Out</h1>
        <p>Pelajari setiap materi dalam modul latihan untuk mendapatkan pemahaman yang lebih dalam.</p>
    </div>

    <div class="row mt-4" id="materiContainer"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Detail Materi -->
                <div class="row mb-2">
                    <label for="materiTitle" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="materiTitle" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="materiDesc" class="col-sm-3 col-form-label">Desc</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="materiDesc" readonly>
                    </div>
                </div>

                <!-- Table Pembahasan -->
                <div class="card">
                    <div class="card-header bg-warning">
                        <div class="row">
                            <div class="col-md-8">Pembahasan</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="tableDiscuss">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <!-- Table Soal -->
                <div class="card">
                    <div class="card-header bg-warning">Soal</div>
                    <div class="card-body">
                        <table class="table table-bordered" id="tableQuiz">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Options</th>
                                    <th>Answer</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Ambil daftar materi dari database
        $.ajax({
            url: "<?= base_url('Materi/get_materi') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log("Data Materi:", data);

                let cardData = "";
                $.each(data, function(index, item) {
                    if (!item.chapter_id) {
                        console.warn("Warning: Materi tanpa ID ditemukan!", item);
                        return; // Skip jika tidak ada chapter_id
                    }

                    cardData += `<div class="col-md-4 col-sm-6">
                        <div class="text-decoration-none materi-link" 
                             data-id="${item.chapter_id}" 
                             data-name="${item.chapter_name}" 
                             data-desc="${item.desc}" 
                             style="cursor: pointer;">
                            <div class="bg-warning p-4 my-3 text-white rounded shadow" style="min-height: 160px;">
                                <h3>${item.chapter_name}</h3>
                                <p>${item.desc}</p>
                                <small class="text-light">Modul: ${item.modul_name}</small>
                            </div>
                        </div>
                    </div>`;
                });

                $("#materiContainer").html(cardData);
            },
            error: function(xhr, status, error) {
                console.error("Gagal mengambil data:", error);
            }
        });

        $(document).on("click", ".materi-link", function() {
            let chapterId = $(this).attr("data-id");
            let chapterName = $(this).attr("data-name");
            let chapterDesc = $(this).attr("data-desc");

            console.log("Debug: Chapter ID =", chapterId);

            if (!chapterId) {
                alert("Error: chapter_id tidak ditemukan!");
                return;
            }

            // Set nilai ke input readonly
            $("#materiTitle").val(chapterName);
            $("#materiDesc").val(chapterDesc);

            $.ajax({
                url: "<?= base_url('Materi/get_discuss/') ?>" + chapterId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log("Data Discuss:", data);

                    if (typeof data !== "object") {
                        console.error("Error: Data bukan JSON!", data);
                        alert("Terjadi kesalahan! Data yang diterima tidak valid.");
                        return;
                    }

                    let tableData = "";
                    if (Array.isArray(data) && data.length > 0) {
                        $.each(data, function(index, item) {
                            let youtubeThumbnail = '-';
                            if (item.link && (item.link.includes("youtube.com") || item.link.includes("youtu.be"))) {
                                let videoId = item.link.split("v=")[1] || item.link.split("/").pop();
                                videoId = videoId.split("&")[0];
                                youtubeThumbnail = `<a href="${item.link}" target="_blank">
                                <img src="https://img.youtube.com/vi/${videoId}/0.jpg" width="120">
                            </a>`;
                            }
                            tableData += `<tr>
                            <td>${item.name}</td>
                            <td>${item.desc}</td>
                            <td>${youtubeThumbnail}</td>
                            <td>${item.filepath ? `<a href="${item.filepath}" target="_blank">${item.filename}</a>` : '-'}</td>
                        </tr>`;
                        });
                    } else {
                        tableData = "<tr><td colspan='4'>Tidak ada data pembahasan</td></tr>";
                    }

                    $("#tableDiscuss tbody").html(tableData);
                    $("#modalDetail").modal("show");
                },
                error: function(xhr, status, error) {
                    console.error("Error Ajax:", xhr.responseText);
                    alert("Terjadi kesalahan saat mengambil data!");
                }
            });
        });

    });
</script>

<?php $this->load->view('template/footer'); ?>