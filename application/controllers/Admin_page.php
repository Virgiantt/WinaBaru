<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_page extends CI_Controller {
	function __construct() {
		parent::__construct();
		// is_logged_in();
	}

	function index() {
		$data['pages'] 	= "Halaman Aksesibilitas";

		$this->load->model('Aksesiblitas_model','s_model');
		$this->load->model('Auth_model', 'a_model');
		$id = 1;
		$data['sidebar']= $this->s_model->getsidebar($id);
		$data['online_users'] = $this->a_model->getOnlineUsers();

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_dashboard', $data);
		$this->load->view('template/footer');
	}

	function create_user() {
		$query 	= "SELECT * FROM tbl_pegawai WHERE aktif=1";
		$data 	= $this->db->query($query)->result_array();

		foreach ($data as $dt) {
			$username = $dt['nup'];
			$password = password_hash($dt['nup'],PASSWORD_DEFAULT);
			$password2 = $dt['nup'];
			$id_jabatan = $dt['id_jabatan'];
			$id_pegawai = $dt['id_pegawai'];
			$nama_pegawai = $dt['nama_pegawai'];

			$data 	= array(
				'username' => $username,
				'password' => $password,
				'password2' => $password2,
				'id_jabatan' => $id_jabatan,
				'id_pegawai' => $id_pegawai,
				'nama' => $nama_pegawai,
				'aktif' => '1',
				'visible' => '1'
			);

			$this->db->insert('tbl_user', $data);
		}
	}

	//=====================================================================================================//
	//====================================== MAIN MENU ====================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== MAIN PAGE ====================================================//
	//=====================================================================================================//
	function main_page() {
		$data['pages'] 	= "Halaman Main Page Menu";

		$this->load->model('Aksesiblitas_model','s_model');
		$id = 1;
		$data['sidebar'] 	= $this->s_model->getsidebar($id);
		$data['list']		= $this->s_model->getlistmainpagemenu();
		// $data['option'] 	= $this->s_model->getlistopt();

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_main_page', $data);
		$this->load->view('template/footer');
	}

	function simpan_main_page_baru() {
		date_default_timezone_set('Asia/Jakarta');

		$urut 	= 0;
		$q1 	= "SELECT urutan_main_page FROM tbl_main_page ORDER BY urutan_main_page DESC LIMIT 1";
		$dq1 	= $this->db->query($q1)->result_array();
		foreach ($dq1 as $d1) {
			$urut 	= intval($d1['urutan_main_page']) + 1;
		}

		$tgl 	= date('Ymd');
		$date 	= date('Ymd-His');
		$bytes 	= random_bytes(10);

		if(isset($_FILES['photo']['name'])) {
			$config['upload_path'] 	= './assets/img/images/';
			$config['allowed_types']= 'jpg|jpeg|gif|png';
			$config['max_size'] 	= '8192';
			$config['file_name'] 	= 'upload-'.$date.'-'.bin2hex($bytes);

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('photo')) {
				echo $this->upload->display_errors();
			} else {
				$data 	= array('upload_data' => $this->upload->data());

				$this->load->model('Aksesiblitas_model','a_model');

				$nama_page 	= $this->input->post('nama_page');
				$url_page 	= $this->input->post('url_page');
				$photo 		= $data['upload_data']['file_name'];

				$simpan_main_page_baru 	= $this->a_model->simpan_main_page_baru($nama_page, $url_page, $photo, $urut);
				echo json_encode($simpan_main_page_baru);
			}
		}
	}

	function check_available_main_page() {
		$this->load->model('Aksesiblitas_model','a_model');

		$id 	= $this->input->post('id');

		$check_available_main_page = $this->a_model->check_available_main_page($id);

		echo json_encode($check_available_main_page);
	}

	function get_main_page_edit_by_id() {
		$this->load->model('Aksesiblitas_model','a_model');

		$id 	= $this->input->post('id');

		$get_main_page_edit_by_id = $this->a_model->get_main_page_edit_by_id($id);

		echo json_encode($get_main_page_edit_by_id);
	}

	function simpan_edit_main_page() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','a_model');

			$id 	= $this->input->post('id', true);
			$nama 	= $this->input->post('nama', true);
			$url 	= $this->input->post('url', true);

			$simpan_edit_main_page 	= $this->a_model->simpan_edit_main_page($id, $nama, $url);

			echo json_encode('Data Berhasil Dirubah!');
		}
	}

	function simpan_edit_gambar_main_page() {
		date_default_timezone_set('Asia/Jakarta');

		$tgl 	= date('Ymd');
		$date 	= date('Ymd-His');
		$bytes 	= random_bytes(10);

		if(isset($_FILES['photo']['name'])) {
			$config['upload_path'] 	= './assets/img/images/';
			$config['allowed_types']= 'jpg|jpeg|gif|png';
			$config['max_size'] 	= '8192';
			$config['file_name'] 	= 'upload-'.$date.'-'.bin2hex($bytes);

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('photo')) {
				echo $this->upload->display_errors();
			} else {
				$data 	= array('upload_data' => $this->upload->data());

				$this->load->model('Aksesiblitas_model','a_model');

				$id_page_edit_image = $this->input->post('id_page_edit_image');
				$old_image 			= $this->input->post('gambar_lama');
				$photo 				= $data['upload_data']['file_name'];

				$simpan_main_page_baru 	= $this->a_model->simpan_edit_gambar_main_page($id_page_edit_image, $photo);
				unlink(FCPATH.'assets/img/images/'.$old_image);

				echo json_encode($simpan_main_page_baru);
			}
		}
	}

	function aktifnonaktif_main_page() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','a_model');

			$id 	= $this->input->post('id', true);

			$aktif 	= "";
			$visible= "";

			$get_id = $this->a_model->get_main_page_edit_by_id($id);
			foreach ($get_id as $gid) {
				$aktif 	= $gid->aktif;
				$visible= $gid->visible;
			}

			$msg 	= "";

			if($aktif == "1" && $visible == "1") {
				$nonaktifkan 	= $this->a_model->nonaktikan_main_page($id);
				$hapus_akses 	= $this->a_model->hapus_akses_main_page($id);
				$msg 			= "Menu Berhasil Di-nonaktifkan!";
			} else {
				$aktifkan 		= $this->a_model->aktifkan_main_page($id);
				$msg 			= "Menu Berhasil Diaktifkan.. Jika hendak memberikan akses, silahkan masuk ke menu Menejemen Akses";
			}

			echo json_encode($msg);
		}
	}

	function urutan_main_page() {
		$this->load->model('Aksesiblitas_model','a_model');

		$data['pages'] 	= "Urutan Main Page";
		$data['menu_id']= 1;
		$id = 1;
		$data['list'] 	= $this->a_model->getsidebar($id);

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_urutan_main_page', $data);
		$this->load->view('template/footer');
	}

	function simpan_urutan_main_page() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','a_model');

			$list 	= $this->input->post('data_table');

			$data 	= $this->a_model->simpan_urutan_main_page($list);

			$msg 	= [
				'sukses' => 'Data Urutan Main Page Berhasil Disimpan!'
			];

			echo json_encode($msg);
		}
	}

	function get_list_main_page_menu() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','a_model');

			$get_list_main_page_menu 	= $this->a_model->getlistmainpagemenu();

			echo json_encode($get_list_main_page_menu);
		}
	}

	function simpan_urutan_main_page_by_edit() {
		$this->load->model('Aksesiblitas_model','a_model');
		$input_data = json_decode($this->input->raw_input_stream, true);

		if (!isset($input_data['updatedOrder']) || !isset($input_data['logData'])) {
			$this->output
			->set_content_type('application/json')
			->set_status_header(400)
			->set_output(json_encode(['error' => 'Invalid input data']));
			return;
		}

		$updatedOrder = $input_data['updatedOrder'];
		$logData = $input_data['logData'];

		$this->db->trans_start();

		foreach ($updatedOrder as $order) {
			$this->a_model->update_order($order['main_page'], $order['no_urut']);
		}

		if (!empty($logData)) {
			$this->a_model->insert_log($logData);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->output
			->set_content_type('application/json')
			->set_status_header(500)
			->set_output(json_encode(['error' => 'Failed to save data']));
		} else {
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['success' => 'Data saved successfully']));
		}
	}
	//=====================================================================================================//
	//====================================== MAIN PAGE ====================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== MENU =========================================================//
	//=====================================================================================================//
	function menu() {
		$data['pages'] 	= "Halaman Menu";

		$this->load->model('Aksesiblitas_model','s_model');
		$id = 1;
		$data['sidebar']= $this->s_model->getsidebar($id);
		// $data['m_page']		= $this->s_model->getlistallmenu();
		$data['list'] 	= $this->s_model->get_list_submenu();

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_menu', $data);
		$this->load->view('template/footer');
	}

	function simpan_menu_baru() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','a_model');

			$id 	= $this->input->post('id', true);
			$nama 	= $this->input->post('nama', true);
			$icon 	= $this->input->post('icon', true);
			$url 	= $this->input->post('url', true);
			$url_leading = "";
			$no_urut = 0;

			$get_main_page 	= "SELECT url_page FROM tbl_main_page WHERE id_main_page='$id'";
			$l_m_data 	= $this->db->query($get_main_page)->result_array();
			foreach ($l_m_data as $lmd) {
				$url_leading 	= $lmd['url_page']."/".$url;
			}

			$get_urutan 	= "SELECT urutan_menu FROM tbl_menu WHERE id_main_page='$id' AND parent_menu='0' AND is_proses='0' ORDER BY urutan_menu DESC LIMIT 1";
			$l_d_urutan 	= $this->db->query($get_urutan)->result_array();
			foreach ($l_d_urutan as $ldu) {
				$no_urut 	= intval($ldu['urutan_menu'])+1;
			}

			$simpan_menu_baru 	= $this->a_model->simpan_menu_baru($id, $nama, $icon, $url_leading, $no_urut);

			echo json_encode('Data Menu Berhasil Disimpan!');
		}
	}

	function check_available_menu() {
		$this->load->model('Aksesiblitas_model','a_model');

		$id 	= $this->input->post('id');

		$check_available_menu = $this->a_model->check_available_menu($id);

		echo json_encode($check_available_menu);
	}

	function get_menu_by_id() {
		$this->load->model('Aksesiblitas_model','a_model');

		$id 	= $this->input->post('id');

		$get_menu_by_id = $this->a_model->get_menu_by_id($id);

		echo json_encode($get_menu_by_id);
	}

	function simpan_edit_menu() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','a_model');

			$id 	= $this->input->post('id', true);
			$nama 	= $this->input->post('nama', true);

			$simpan_edit_menu 	= $this->a_model->simpan_edit_menu($id, $nama);

			echo json_encode('Data Menu Berhasil Dirubah!');
		}
	}

	function aktifnonaktif_menu() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','a_model');

			$id 	= $this->input->post('id', true);

			$aktif 	= "";
			$visible= "";

			$get_id = $this->a_model->get_menu_by_id($id);
			foreach ($get_id as $gid) {
				$aktif 	= $gid->aktif;
				$visible= $gid->visible;
			}

			$msg 	= "";

			if($aktif == "1" && $visible == "1") {
				$nonaktifkan 	= $this->a_model->nonaktikan_menu($id);
				$hapus_akses 	= $this->a_model->hapus_akses_menu($id);
				$msg 			= "Menu Berhasil Di-nonaktifkan!";
			} else {
				$aktifkan 		= $this->a_model->aktifkan_menu($id);
				$msg 			= "Menu Berhasil Diaktifkan.. Jika hendak memberikan akses, silahkan masuk ke menu Menejemen Akses";
			}

			echo json_encode($msg);
		}
	}

	function urutan_menu() {
		$this->load->model('Aksesiblitas_model','a_model');

		$data['pages'] 	= "Urutkan Menu";
		$data['menu_id']= 1;
		$data['list'] 	= $this->a_model->get_list_submenu();

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_urutan_menu', $data);
		$this->load->view('template/footer');
	}

	function simpan_urutan_menu() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','a_model');

			$list 	= $this->input->post('data_table');

			$data 	= $this->a_model->simpan_urutan_menu($list);

			$msg 	= [
				'sukses' => 'Data Urutan Menu Berhasil Disimpan!'
			];

			echo json_encode($msg);
		}
	}

	function get_list_main_page_by_edit_menu() {
		$data = $this->db->get_where('tbl_main_page', array('aktif' => '1', 'visible' => '1'))->result_array();
		echo json_encode($data);
	}

	function get_list_menu_by_id_main_page() {
		if($this->input->is_ajax_request() == true) {

			$id 	= $this->input->post('id', true);

			$query 	= "SELECT prefix_menu FROM tbl_menu WHERE id_main_page='$id' GROUP BY prefix_menu";
			$data 	= $this->db->query($query)->result_array();

			echo json_encode($data);
		}
	}

	function get_list_menu_by_prefix() {
		if($this->input->is_ajax_request() == true) {

			$prefix = $this->input->post('prefix', true);
			$id 	= $this->input->post('id', true);

			$query 	= "SELECT * FROM tbl_menu WHERE prefix_menu='$prefix' AND id_main_page = '$id' ORDER BY urutan_menu ASC";
			$data 	= $this->db->query($query)->result_array();
			echo json_encode($data);
		}
	}

	function simpan_urutan_menu_by_edit() {
		$this->load->model('Aksesiblitas_model','a_model');
		$input_data = json_decode($this->input->raw_input_stream, true);

		if (!isset($input_data['updatedOrder']) || !isset($input_data['logData'])) {
			$this->output
			->set_content_type('application/json')
			->set_status_header(400)
			->set_output(json_encode(['error' => 'Invalid input data']));
			return;
		}

		$updatedOrder = $input_data['updatedOrder'];
		$logData = $input_data['logData'];

		$this->db->trans_start();

		foreach ($updatedOrder as $order) {
			$this->a_model->update_order_menu($order['main_page'], $order['no_urut']);
		}

		if (!empty($logData)) {
			$this->a_model->insert_log_menu($logData);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->output
			->set_content_type('application/json')
			->set_status_header(500)
			->set_output(json_encode(['error' => 'Failed to save data']));
		} else {
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['success' => 'Data saved successfully']));
		}
	}
	//=====================================================================================================//
	//====================================== MENU =========================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== PROSES =======================================================//
	//=====================================================================================================//
	function proses() {
		$data['pages'] 	= "Halaman Proses";

		$this->load->model('Aksesiblitas_model','s_model');
		$id = 1;
		$data['sidebar']= $this->s_model->getsidebar($id);
		$data['list'] 	= $this->s_model->get_list_proses();

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_proses', $data);
		$this->load->view('template/footer');
	}

	function get_menu_by_main_page() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','s_model');

			$id 	= $this->input->post('id', true);

			$get_menu_by_main_page = $this->s_model->get_menu_by_main_page($id);

			echo json_encode($get_menu_by_main_page);
		}
	}

	function simpan_proses_baru() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','s_model');

			$id 	= $this->input->post('id', true);
			$idm 	= $this->input->post('idm', true);
			$nama 	= $this->input->post('nama', true);
			$icon 	= $this->input->post('icon', true);
			$url 	= $this->input->post('url', true);
			$vurl 	= "";
			$no_urut= 0;

			$query 	= "SELECT url_main_page FROM tbl_main_page WHERE id_main_page='$id'";
			$data 	= $this->db->query($query)->result_array();
			foreach ($data as $dt) {
				$vurl 	= $dt['url_main_page']."/".$url;
			}

			$query1 = "SELECT IFNULL((SELECT urutan_proses FROM tbl_proses WHERE id_menu=$idm ORDER BY urutan_proses DESC limit 1), 0) as urutan_proses";
			$data1 	= $this->db->query($query1)->result_array();
			foreach ($data1 as $dt1) {
				$no_urut= $dt1['urutan_proses']+1;
			}

			$simpan_proses_baru 	= $this->s_model->simpan_proses_baru($nama, $icon, $vurl, $idm, $no_urut);

			$msg 	= 'Proses Baru Berhasil Disimpan!';

			echo json_encode($msg);
		}
	}
	//=====================================================================================================//
	//====================================== PROSES =======================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== MAIN MENU ====================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== USER =========================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== USER AKTIF ===================================================//
	//=====================================================================================================//
	function user_aktif() {
		$data['pages'] 	= "Halaman User Aktif";

		$this->load->model('Aksesiblitas_model','s_model');
		$data['sidebar']	= $this->s_model->getsidebar();
		$data['list']		= $this->s_model->getlistalluseraktif();

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_user_aktif', $data);
		$this->load->view('template/footer');
	}

	function nonaktifkan_user() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','s_model');

			$id 	= $this->input->post('id', true);

			$nonaktifkan_user = $this->s_model->nonaktifkan_user($id);

			echo json_encode($nonaktifkan_user);
		}
	}
	//=====================================================================================================//
	//====================================== USER AKTIF ===================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== USER NONAKTIF ================================================//
	//=====================================================================================================//
	function user_nonaktif() {
		$data['pages'] 	= "Halaman User Non-aktif";

		$this->load->model('Aksesiblitas_model','s_model');
		$data['sidebar']= $this->s_model->getsidebar();
		$data['list']		= $this->s_model->getlistallusernonaktif();

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_user_nonaktif', $data);
		$this->load->view('template/footer');
	}

	function aktifkan_user() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','s_model');

			$id 		= $this->input->post('id', true);
			$username 	= $this->input->post('username', true);

			$aktifkan_user = $this->s_model->aktifkan_user($id, $username);

			echo json_encode($aktifkan_user);
		}
	}
	//=====================================================================================================//
	//====================================== USER NONAKTIF ================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== USER =========================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== HAK AKSES ====================================================//
	//=====================================================================================================//
	function hak_akses() {
		$data['pages'] 	= "Halaman Hak Akses";

		$this->load->model('Aksesiblitas_model','s_model');
		$id = 1;
		$data['sidebar']= $this->s_model->getsidebar($id);
		$data['list']		= $this->s_model->getalljabatan();

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_hak_akses', $data);
		$this->load->view('template/footer');
	}

	function get_akses_menu_per_user() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','s_model');

			$id 	= $this->input->post('id', true);

			$list 	= array();

			$query 	= "SELECT * FROM tbl_menu WHERE aktif='1' AND visible='1'";
			$data 	= $this->db->query($query)->result_array();
			foreach ($data as $dt) {
				$id_menu 	= $dt['id_menu'];
				$nama_menu 	= $dt['nama_menu'];
				$check 		= "";

				$get_akses_menu_per_user = $this->s_model->get_akses_menu_per_user($id, $id_menu);
				foreach ($get_akses_menu_per_user as $gampu) {
					$check 	= $gampu->check;
				}

				$lists 		= array(
					'id_menu' 	=> $id_menu,
					'nama_menu' => $nama_menu,
					'check' 	=> $check
				);

				$list[] 	= $lists;
			}


			echo json_encode($list);
		}
	}

	function get_akses_dashboard_per_user() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','s_model');

			$id 	= $this->input->post('id', true);

			$list 	= array();

			$query 	= "SELECT * FROM tbl_dashboard";
			$data 	= $this->db->query($query)->result_array();
			foreach ($data as $dt) {
				$id_dashboard 	= $dt['id_dashboard'];
				$nama_menu 		= $dt['nama_menu'];
				$check 			= "";

				$get_akses_dashboard_per_user = $this->s_model->get_akses_dashboard_per_user($id, $id_dashboard);
				foreach ($get_akses_dashboard_per_user as $gadpu) {
					$check 		= $gadpu->check;
				}

				$lists 			= array(
					'id_dashboard' 	=> $id_dashboard,
					'nama_menu' => $nama_menu,
					'check' 	=> $check
				);

				$list[] 	= $lists;
			}


			echo json_encode($list);
		}
	}

	function get_akses_sidemenu_per_user() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','s_model');

			$id 	= $this->input->post('id', true);

			$list 	= array();

			$query 	= "SELECT * FROM tbl_sidemenu WHERE aktif='1' AND visible='1'";
			$data 	= $this->db->query($query)->result_array();
			foreach ($data as $dt) {
				$id_sidemenu 	= $dt['id_sidemenu'];
				$nama_sidemenu 		= $dt['nama_sidemenu'];
				$check 			= "";

				$get_akses_sidemenu_per_user = $this->s_model->get_akses_sidemenu_per_user($id, $id_sidemenu);
				foreach ($get_akses_sidemenu_per_user as $gaspu) {
					$check 		= $gaspu->check;
				}

				$lists 			= array(
					'id_sidemenu' 	=> $id_sidemenu,
					'nama_sidemenu' => $nama_sidemenu,
					'check' 		=> $check
				);

				$list[] 	= $lists;
			}


			echo json_encode($list);
		}
	}

	function berikan_akses($id, $nama_jabatan) {
		$this->load->model('Aksesiblitas_model','a_model');

		$data['pages'] 	= "Berikan Akses Untuk <b>".urldecode($nama_jabatan)."</b>";
		$data['menu_id']= 1;
		$data['list'] 	= $this->a_model->get_list_submenu();

		$this->load->view('template/header');
		$this->load->view('aksesibilitas/ak_topbar');
		$this->load->view('aksesibilitas/ak_sidebar',$data);
		$this->load->view('aksesibilitas/ak_berikan_akses', $data);
		$this->load->view('template/footer');
	}

	function check_access_main_page() {
		$id_jabatan = $this->input->post('id_jabatan');
		$accessData = $this->input->post('accessData');

		$this->load->model('Aksesiblitas_model', 'a_model');
		$response = ["message" => "Data processed successfully."];

		foreach ($accessData as $access) {
			$id_main_page = $access['id_main_page'];
			$checked = $access['checked'];

			$exists = $this->a_model->check_access_exists_main_page($id_jabatan, $id_main_page);

			if ($checked && !$exists) {
				$this->a_model->add_access_main_page($id_jabatan, $id_main_page);
			} elseif (!$checked && $exists) {
				$this->a_model->remove_access_main_page($id_jabatan, $id_main_page);
			}
		}

		echo json_encode($response);
	}
	//=====================================================================================================//
	//====================================== HAK AKSES ====================================================//
	//=====================================================================================================//

	//=====================================================================================================//
	//====================================== DOWNLOAD APLIKASI ============================================//
	//=====================================================================================================//
	function get_list_aplikasi_android() {
		if($this->input->is_ajax_request() == true) {
			$this->load->model('Aksesiblitas_model','s_model');

			$id 	= $this->input->post('id', true);

			$get_list_aplikasi_android 	= $this->s_model->get_list_aplikasi_android($id);

			echo json_encode($get_list_aplikasi_android);
		}
	}
	//=====================================================================================================//
	//====================================== DOWNLOAD APLIKASI ============================================//
	//=====================================================================================================//
}