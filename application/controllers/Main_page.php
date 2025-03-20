<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_page extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	function index()
	{
		if(!$this->session->userdata('username')) {
			redirect('auth');
		} else {
			$this->main_page();
		}
	}

	function main_page() {
		$this->load->model('Mainpage_model','m_model');

		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['pegawai'] 	= $this->m_model->get_detail_pegawai();
		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('dashboard',$data);
		$this->load->view('template/footer');
	}

	function semua_notifikasi() {
		$this->load->model('Mainpage_model','m_model');

		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['pegawai'] 	= $this->m_model->get_detail_pegawai();

		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('all_notifications',$data);
		$this->load->view('template/footer');
	}

	function semua_pesan() {
		$this->load->model('Mainpage_model','m_model');

		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['pegawai'] 	= $this->m_model->get_detail_pegawai();

		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('all_messages',$data);
		$this->load->view('template/footer');
	}
	public function cekakun() {
		$id = $this->session->userdata('id_pegawai');
		$query = $this->db->query("SELECT id_jabatan, status_jabatan FROM tbl_detail_jabatan WHERE id_pegawai = ?", [$id]);
	
		if ($query->num_rows() > 0) {
			$jabatans = $query->result_array();
	
			echo json_encode([
				'ganti_akun' => count($jabatans) > 1,
				'jabatans' => $jabatans
			]);
		} else {
			echo json_encode([
				'ganti_akun' => false,
				'jabatans' => [],
				'message' => 'Pegawai tidak memiliki jabatan'
			]);
		}
	}
	public function ganti_jabatan() {
		$id_jabatan = $this->input->post('id_jabatan');
	
		if ($id_jabatan) {
			$this->session->set_userdata('id_jabatan', $id_jabatan);
			echo json_encode(['status' => 'success', 'message' => 'Jabatan berhasil diubah']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal mengubah jabatan']);
		}
	}
	
}