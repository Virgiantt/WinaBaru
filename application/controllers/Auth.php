<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if (!$this->session->userdata('username')) {
			if ($this->form_validation->run() == false) {
				$this->load->view('login_screen');
			} else {
				$this->_login();
			}
		} else {
			redirect('main_page');
		}
	}

	private function _login()
	{
		$this->load->model('Auth_model', 'a_model');

		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');

		$user 		= $this->db->get_where('user', ['username' => $username])->row_array();

		// Cek user
		if ($user) {
			if ($user['is_blocked'] == 1) {
				// Pengguna diblokir
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="float-right">Akun anda telah diblokir setelah 5 kali salah memasukkan password.<p></div>');
				redirect('auth');
			}

			if ($user['aktif'] == 1) {
				if (password_verify($password, $user['password'])) {
					// Kata sandi benar, reset percobaan login
					$this->db->update('user', ['login_attempts' => 0], ['username' => $username]);

					date_default_timezone_set('Asia/Jakarta');

					// Cek login_log
					$check = "SELECT * FROM login_log WHERE username='$username'";
					$q_check = $this->db->query($check)->result_array();
					if (count($q_check) < 1) {
						$login 	= [
							'username' => $user['username'],
							'timestamp' => date('Y-m-d H:i:s')
						];
						$this->db->insert('login_log', $login);
					} else {
						$login 	= [
							'timestamp' => date('Y-m-d H:i:s')
						];
						$this->db->update('login_log', $login, ['username' => $username]);
					}

					$data = [
						'user_id' => $user['id'],
						'username' => $user['username'],
						'name' => $user['name'],
						'token' => $user['token'],
						'jabatan_id' => $user['jabatan_id'],
						'depart_id' => $user['depart_id'],
						'role' => $user['role']
					];
					$this->session->set_userdata($data);


					redirect('Welcome');
				} else {
					$login_attempts = $user['login_attempts'] + 1;

					if ($login_attempts >= 5) {
						// Blokir pengguna
						$this->db->update('user', ['is_blocked' => 1], ['username' => $username]);
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="float-right">Akun anda telah diblokir setelah 5 kali salah memasukkan password.<p></div>');
					} else {
						// Tambah percobaan login
						$this->db->update('user', ['login_attempts' => $login_attempts], ['username' => $username]);
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="float-right">Password Salah!<p></div>');
					}

					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="float-right">Username Tidak Aktif!<p></div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="float-right">Username Tidak Ada!<p></div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('jabatan_id');
		$this->session->unset_userdata('token');
		$this->session->unset_userdata('role'); // Hapus session role saat logout

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><p class="float-right">Anda Sudah Logout!<p></div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('blocked');
	}

	public function error404()
	{
		if ($this->session->userdata('role') == 2) {
			$this->load->view('user/kelas/index');
		} else {
			$this->load->view('kepegawaian/no_access');
		}
	}
}
