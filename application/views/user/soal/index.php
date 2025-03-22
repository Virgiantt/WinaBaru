
<?php
$this->load->view('template/header');
$this->load->view('template/topbar');

// Ambil data soal dari database
$query = $this->db->get('quiz');
$questions = $query->result();
?>

<div class="container mt-4">
    <h2 class="text-dark">Kerjakan Latihan</h2>

    <div class="row">
        <div class="col-md-8">
            <?php foreach ($questions as $index => $question) : ?>
                <div class="card p-3 mb-3">
                    <h5 class="text-dark"><?= ($index + 1) . ". " . $question->question; ?></h5>


                    <div class="answer-selection mt-3">
                        <label>Pilih Jawaban:</label>
                        <?php foreach (['A', 'B', 'C', 'D', 'E'] as $key => $label) : ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban_<?= $index; ?>" value="<?= $label; ?>">
                                <label class="form-check-label"><?= $label; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5 class="text-dark">Waktu Tersisa: <span id="timer">15m 1s</span></h5>
                <div class="alert alert-danger">
                    Mohon Tidak Refresh Halaman, ketika Refresh Halaman anda akan dianggap selesai mengerjakan.
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-danger">Batalkan</button>
                    <button class="btn btn-success">Selesai</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .answer-options table {
        width: 100%;
    }

    .answer-options td {
        padding: 10px;
        text-align: left;
    }

    .answer-options td:nth-child(3) {
        width: 20%;
        font-weight: bold;
        color: green;
    }
</style>

<script>
    // Timer hitung mundur
    let timeLeft = 901; // 15 menit 1 detik dalam detik
    const timerElement = document.getElementById("timer");

    function updateTimer() {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        timerElement.textContent = `${minutes}m ${seconds}s`;

        if (timeLeft > 0) {
            timeLeft--;
            setTimeout(updateTimer, 1000);
        } else {
            alert("Waktu habis! Jawaban akan dikumpulkan.");
        }
    }

    updateTimer();
</script>

<?php $this->load->view('template/footer'); ?>