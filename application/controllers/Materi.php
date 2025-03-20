<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MateriModel');
        $this->load->database();
    }

    public function index()
    {
        $this->load->view('user/materi/index'); // Tampilkan view pelatihan
    }

    public function get_materi()
    {
        $data = $this->MateriModel->get_all_materi();
        echo json_encode($data);
    }

    public function get_discuss($chapter_id)
    {
        $data = $this->db->get_where('discuss', ['chapter_id' => $chapter_id])->result();

        // Kirim data dalam format JSON
        echo json_encode($data);
    }
}
