<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modul extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModulModel'); // Load model
    }

    public function index()
    {
        $this->load->view('user/modul/index'); // Tampilkan view pelatihan
    }

    public function get_modul()
    {
        $data = $this->ModulModel->get_all_modul();
        echo json_encode($data);
    }
}
