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
                        <?php
                        $options = [
                            'A' => $question->opt_1,
                            'B' => $question->opt_2,
                            'C' => $question->opt_3,
                            'D' => $question->opt_4,
                            'E' => $question->opt_5
                        ];

                        $answers = [
                            'A' => $question->ans_1,
                            'B' => $question->ans_2,
                            'C' => $question->ans_3,
                            'D' => $question->ans_4,
                            'E' => $question->ans_5
                        ];

                        foreach ($options as $label => $option) :
                            if (!empty($option)) :
                        ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="jawaban_<?= $index; ?>_<?= $label; ?>"
                                        name="jawaban_<?= $index; ?>" value="<?= $label; ?>">
                                    <label class="form-check-label" for="jawaban_<?= $index; ?>_<?= $label; ?>">
                                        <?= $label . ". " . $answers[$label]; ?>
                                    </label>
                                </div>
                        <?php
                            endif;
                        endforeach;
                        ?>
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
                    <button class="btn btn-success w-50 ms-2" onclick="submitQuiz()">Selesai</button>
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
        Swal.fire({
            title: "Yakin ingin membatalkan?",
            text: "Semua jawaban akan hilang dan Anda tidak bisa mengulang!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Batalkan!",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('pembahasan/index/' . $chapter_id) ?>";
            }
        });
    }

    function submitQuiz() {
        Swal.fire({
            title: "Yakin sudah selesai?",
            text: "Pastikan semua jawaban sudah benar sebelum mengirim!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Selesai!",
            cancelButtonText: "Cek Lagi"
        }).then((result) => {
            if (!result.isConfirmed) return;

            let userId = <?= $this->session->userdata('user_id'); ?>;
            let discussId = <?= json_encode($this->session->userdata('discuss_id')); ?>;
            let quizData = [];

            let questions = <?= json_encode($questions); ?>;

            let questionContainers = document.querySelectorAll(".question-container");

            for (let i = 0; i < questionContainers.length; i++) {
                let selectedOption = questionContainers[i].querySelector('input[name="jawaban_' + i + '"]:checked');

                if (selectedOption) {
                    let questionId = questions[i].id;
                    let ansOpt = selectedOption.value;
                    let ansVal = selectedOption.nextElementSibling.textContent.trim();

                    quizData.push({
                        question_id: questionId,
                        answer: ansOpt
                    });

                    console.log("Pertanyaan ke-" + (i + 1) + ": " + ansOpt + " (" + ansVal + ")");
                } else {
                    console.log("Pertanyaan ke-" + (i + 1) + ": Belum dijawab");
                }
            }

            console.log("Quiz Data:", quizData);
            if (quizData.length === 0) {
                Swal.fire({
                    title: "Oops!",
                    text: "Anda belum menjawab pertanyaan apa pun!",
                    icon: "error"
                });
                return;
            }


            fetch("<?= base_url('Soal/submit_quiz'); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        discuss_id: discussId,
                        answers: quizData
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        Swal.fire({
                            title: "Selesai!",
                            text: "Latihan telah dikumpulkan dengan sukses!",
                            icon: "success",
                            confirmButtonColor: "#3085d6"
                        }).then(() => {
                            window.location.href = "<?= base_url('pembahasan/index/' . $chapter_id) ?>";
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: data.message,
                            icon: "error"
                        });
                    }
                })
                .catch(error => {
                    console.error("Error submitting quiz:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "Terjadi kesalahan saat mengirim jawaban!",
                        icon: "error"
                    });
                });
        });
    }

    let timeLeft = 901;
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
            submitQuiz();
        }
    }

    updateTimer();
</script>

<?php $this->load->view('template/footer'); ?>