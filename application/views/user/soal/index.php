<?php
$this->load->view('template/header');
$this->load->view('template/topbar');

// Ambil data soal dari database
$query = $this->db->get('quiz');
$questions = $query->result();
$total_questions = count($questions);

$chapter_id = isset($chapter_id) ? $chapter_id : 1;

?>

<div class="container mt-4">
    <h2 class="text-dark">Kerjakan Latihan</h2>

    <div class="row">
        <div class="col-md-8">
            <?php foreach ($questions as $index => $question) : ?>
                <div class="card p-3 mb-3 question-container" id="question_<?= $index; ?>" style="<?= $index == 0 ? '' : 'display: none;'; ?>">
                    <h5 class="text-dark"><?= ($index + 1) . ". " . $question->question; ?></h5>

                    <div class="answer-selection mt-3">
                        <label>Pilih Jawaban:</label>
                        <?php foreach (['A', 'B', 'C', 'D', 'E'] as $label) : ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban_<?= $index; ?>" value="<?= $label; ?>">
                                <label class="form-check-label"><?= $label; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Navigasi Soal -->
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-secondary" id="prevBtn" onclick="changeQuestion(-1)" disabled>Sebelumnya</button>
                <button class="btn btn-primary" id="nextBtn" onclick="changeQuestion(1)">Berikutnya</button>
            </div>

            <!-- Pagination Nomor Soal -->
            <div class="pagination-container mt-3">
                <?php for ($i = 0; $i < $total_questions; $i++) : ?>
                    <button class="btn btn-outline-dark pagination-btn" onclick="goToQuestion(<?= $i; ?>)" id="page_<?= $i; ?>">
                        <?= $i + 1; ?>
                    </button>
                <?php endfor; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5 class="text-dark">Waktu Tersisa: <span id="timer">15m 1s</span></h5>
                <div class="alert alert-danger">
                    Mohon Tidak Refresh Halaman, ketika Refresh Halaman anda akan dianggap selesai mengerjakan.
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button class="btn btn-danger w-50" onclick="confirmCancel()">Batalkan</button>
                    <button class="btn btn-success w-50 ms-2">Selesai</button>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .pagination-container {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .pagination-btn {
        width: 40px;
        height: 40px;
        font-weight: bold;
    }

    .pagination-btn.active {
        background-color: #007bff;
        color: white;
    }
</style>

<script>
    let currentQuestion = 0;
    const totalQuestions = <?= $total_questions; ?>;

    function changeQuestion(direction) {
        document.getElementById(`question_${currentQuestion}`).style.display = "none";
        document.getElementById(`page_${currentQuestion}`).classList.remove("active");

        currentQuestion += direction;

        document.getElementById(`question_${currentQuestion}`).style.display = "block";
        document.getElementById(`page_${currentQuestion}`).classList.add("active");

        document.getElementById("prevBtn").disabled = currentQuestion === 0;
        document.getElementById("nextBtn").disabled = currentQuestion === totalQuestions - 1;
    }

    function goToQuestion(index) {
        document.getElementById(`question_${currentQuestion}`).style.display = "none";
        document.getElementById(`page_${currentQuestion}`).classList.remove("active");

        currentQuestion = index;

        document.getElementById(`question_${currentQuestion}`).style.display = "block";
        document.getElementById(`page_${currentQuestion}`).classList.add("active");

        document.getElementById("prevBtn").disabled = currentQuestion === 0;
        document.getElementById("nextBtn").disabled = currentQuestion === totalQuestions - 1;
    }

    function confirmCancel() {
        if (confirm("Apakah Anda yakin ingin membatalkan ujian ini? Semua jawaban akan hilang.")) {
            window.location.href = "<?= base_url('pembahasan/index/' . $chapter_id) ?>";
        }
    }

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