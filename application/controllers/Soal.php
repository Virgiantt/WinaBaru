<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SoalModel');
    }

    public function index($chapter_id)
    {
        $data['soal'] = $this->SoalModel->getSoal($chapter_id);
        $this->load->view('soal/index', $data);
    }
}
