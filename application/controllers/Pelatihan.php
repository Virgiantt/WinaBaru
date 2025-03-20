<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelatihan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LatihanModel'); 
    }

    public function index()
    {
        $this->load->view('user/pelatihan/index'); 
    }

    public function get_pelatihan()
    {
        $data = $this->LatihanModel->get_all_pelatihan();
        echo json_encode($data);
    }
}
