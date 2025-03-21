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
        $this->load->view('user/materi/index');
    }

    public function get_materi()
    {
        $data = $this->MateriModel->get_all_materi();
        echo json_encode($data);
    }

    public function detail($chapter_id)
    {
        $data['materi'] = $this->db->get_where('materi', ['id' => $chapter_id])->row();
        $this->load->view('materi_detail', $data);
    }
}
