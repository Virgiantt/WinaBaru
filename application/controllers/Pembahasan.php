<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembahasan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PembahasanModel');
        $this->load->database();
    }

    public function index($chapter_id)
    {
        $data['materi'] = $this->PembahasanModel->getMateri($chapter_id);
        $data['pembahasan'] = $this->PembahasanModel->getPembahasan($chapter_id);
        $data['soal'] = $this->PembahasanModel->getSoal($chapter_id);

        if (!$data['materi']) {
            show_error('Materi tidak ditemukan', 404);
            return;
        }

        // Pastikan properti ada agar tidak error
        if (!isset($data['materi']->name)) {
            $data['materi']->name = 'Judul Tidak Tersedia';
        }
        if (!isset($data['materi']->desc)) {
            $data['materi']->desc = 'Deskripsi Tidak Tersedia';
        }

        $this->load->view('user/pembahasan/index', $data);
    }

    public function detail($chapter_id)
    {
        $data['materi'] = $this->PembahasanModel->getMateri($chapter_id);
        $this->load->view('user/pembahasan/index', $data);
    }

    public function getPembahasan($chapter_id)
    {
        $pembahasan = $this->PembahasanModel->getPembahasan($chapter_id);
        echo json_encode($pembahasan);
    }

    public function getSoal($chapter_id)
    {
        $soal = $this->PembahasanModel->getSoal($chapter_id);
        echo json_encode($soal);
    }
}
