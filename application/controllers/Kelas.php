<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KelasModel');
        $this->load->library('session'); // Pastikan session di-load
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            $this->session->set_userdata('user_id', 1); // Contoh, pastikan user_id diset
        }

        $this->load->view('user/kelas');
    }

    public function get_kelas()
    {
        header('Content-Type: application/json'); // Pastikan response JSON

        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            echo json_encode(['error' => 'User not logged in']);
            return;
        }

        $data = $this->KelasModel->get_kelas_by_user($user_id);

        // Jika data kosong, kembalikan pesan yang sesuai
        if (empty($data)) {
            echo json_encode(['error' => 'Tidak ada kelas yang tersedia']);
            return;
        }

        echo json_encode(['user_id' => $user_id, 'data' => $data]);
    }
}
