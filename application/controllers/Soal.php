<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SoalModel');
    }

    public function index()
    {
        $this->load->model('SoalModel');
        $data['soal'] = $this->SoalModel->get_all_soal();
        $this->load->view('user/soal/index', $data);
    }
}
