<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect('auth');
		}
		$this->load->model('Mainpage_model', 'm_model');
	}
	public function index()
	{
		$data['main_page'] = $this->m_model->get_list_menu();
		$data['announcement'] = $this->db->get('announcement')->row();
		$data['role'] = $this->session->userdata('role'); // Kirim role ke view

		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('main', $data);
		$this->load->view('template/footer');
	}
}
