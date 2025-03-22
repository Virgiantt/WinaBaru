<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('username')) {
			redirect('auth');
		}
		$this->load->model('Mainpage_model','m_model');
	}
   function index() {
      $this->dashboard();
   }
// DASHBOARD UTAMA
	public function dashboard()
	{
		$data['pages'] 	= 'Dashboard Admin';
		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['announcement'] 	= $this->db->get('announcement')->row();
		$this->load->view('template/header');
		$this->load->view('admin/temp/head');
		$this->load->view('admin/temp/side');
		$this->load->view('admin/dash',$data);
		$this->load->view('template/footer');
	}
// DASHBOARD
   public function learndashboard()
   {
      $data['pages'] 	= 'Dashboard Admin';
      $data['main_page'] 	= $this->m_model->get_list_menu();
      $data['announcement'] 	= $this->db->get('announcement')->row();
      $this->load->view('template/header');
      $this->load->view('admin/temp/head');
      $this->load->view('admin/temp/side');
      $this->load->view('admin/dash',$data);
      $this->load->view('template/footer');
   }
// LEARNKELAS
	public function learnkelas()
	{
		$data['pages'] 	= 'Dashboard Class Course';
		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['announcement'] 	= $this->db->get('announcement')->row();
		$this->load->view('template/header');
		$this->load->view('admin/temp/head');
		$this->load->view('admin/temp/side');
		$this->load->view('admin/kelas',$data);
		$this->load->view('template/footer');
	}
   public function fetch_lkelas()
   {
      $this->db->select('*');
      $query = $this->db->get('learn_class');
      $data = array();
      foreach ($query->result() as $kelas) {
         $data[] = array(
               'id'    => $kelas->id,
               'name'  => $kelas->name,
               'desc'  => $kelas->desc
         );
      }
      $response = array(
         'draw'            => intval($this->input->get('draw')),
         'recordsTotal'    => $this->db->count_all('learn_class'), 
         'recordsFiltered' => $this->db->count_all_results('learn_class'), 
         'data'            => $data 
      );

      // Kirimkan response dalam format JSON
      echo json_encode($response);
   }
   public function getDetailKelas()
   {
      $materi_id = $this->input->post('materi_id');
      $materi = $this->db->get_where('learn_class', ['id' => $materi_id])->row_array();

      // Ambil data pembahasan user
      $this->db->select('lc_access.id, user.name, user.username, user.id as user_id, user.email');
      $this->db->from('lc_access');
      $this->db->join('user', 'lc_access.user_id = user.id');
      $this->db->where('lc_id', $materi_id);
      $discuss = $this->db->get()->result_array();

      // Ambil data soal (quiz)
      $this->db->select('lesson_lc.*,lesson.name,lesson.desc');
      $this->db->from('lesson_lc');
      $this->db->join('lesson', 'lesson.id = lesson_lc.lesson_id');
      $quiz = $this->db->get()->result_array();

      if ($materi) {
         $response = [
               'status' => 'success',
               'materi' => $materi,
               'discuss' => $discuss,
               'quiz' => $quiz
         ];
      } else {
         $response = [
               'status' => 'error',
               'message' => 'Materi tidak ditemukan'
         ];
      }

      echo json_encode($response);
   }
   public function add_lkelas()
   {
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->insert('learn_class', $data);
        echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil ditambahkan'));
   }
   public function edit_lkelas()
   {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->where('id', $id);
        if ($this->db->update('learn_class', $data)) {
         echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil diperbarui'));
        }else{
         echo json_encode(array('status' => 'errorr', 'message' => 'Data kelas berhasil diperbarui'));
        }
   }
   public function delete_lkelas()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('learn_class');
        echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil dihapus'));
   }
// learnpelatihan
	public function learnpelatihan()
	{
		$data['pages'] 	= 'Dashboard Pelatihan Course';
		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['announcement'] 	= $this->db->get('announcement')->row();
		$this->load->view('template/header');
		$this->load->view('admin/temp/head');
		$this->load->view('admin/temp/side');
		$this->load->view('admin/lesson',$data); // lesson as pelatihan
		$this->load->view('template/footer');
	}
   public function fetch_lpelatihan()
   {
      $this->db->select('*');
      $query = $this->db->get('lesson');
      $data = array();
      foreach ($query->result() as $kelas) {
         $data[] = array(
               'id'    => $kelas->id,
               'name'  => $kelas->name,
               'desc'  => $kelas->desc
         );
      }
      $response = array(
         'draw'            => intval($this->input->get('draw')),
         'recordsTotal'    => $this->db->count_all('lesson'), 
         'recordsFiltered' => $this->db->count_all_results('lesson'), 
         'data'            => $data 
      );

      // Kirimkan response dalam format JSON
      echo json_encode($response);
   }
   public function add_lpelatihan()
   {
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->insert('lesson', $data);
        echo json_encode(array('status' => 'success', 'message' => 'Data Pelatihan berhasil ditambahkan'));
   }
   public function edit_lpelatihan()
   {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->where('id', $id);
        if ($this->db->update('lesson', $data)) {
         echo json_encode(array('status' => 'success', 'message' => 'Data Pelatihan berhasil diperbarui'));
        }else{
         echo json_encode(array('status' => 'errorr', 'message' => 'Data Pelatihan berhasil diperbarui'));
        }
   }
   public function delete_lpelatihan()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('lesson');
        echo json_encode(array('status' => 'success', 'message' => 'Data Pelatihan berhasil dihapus'));
   }
   
   public function getlessonModul()
   {
      $lesson_id = $this->input->post('lesson_id');
      $materi = $this->db->get_where('lesson', ['id' => $lesson_id])->row_array();

      // Ambil data pembahasan (discuss)
      $this->db->select('lesson_modul.*,modul.name,modul.desc');
      $this->db->from('modul');
      $this->db->join('lesson_modul', 'lesson_modul.modul_id = modul.id');
      $this->db->where('lesson_modul.lesson_id', $lesson_id);
      $discuss = $this->db->get()->result_array();

      if ($materi) {
         $response = [
               'status' => 'success',
               'materi' => $materi,
               'discuss' => $discuss
         ];
      } else {
         $response = [
               'status' => 'error',
               'message' => 'Pelatihan tidak ditemukan'
         ];
      }

      echo json_encode($response);
   }
   public function add_lesson_modul()
   {
      $modul_id = $this->input->post('idmodul');
      $lesson_id = $this->input->post('lesson_id');

      // Cek apakah kombinasi modul_id dan lesson_id sudah ada
      $exists = $this->db->get_where('lesson_modul', [
         'modul_id' => $modul_id,
         'lesson_id' => $lesson_id
      ])->row();

      if ($exists) {
         echo json_encode(array('status' => 'error', 'message' => 'Kombinasi modul sudah ada!'));
         return;
      }

      // Jika belum ada, insert data baru
      $data = array(
         'modul_id' => $modul_id,
         'lesson_id' => $lesson_id
      );

      $this->db->insert('lesson_modul', $data);
      echo json_encode(array('status' => 'success', 'message' => 'Data modul berhasil ditambahkan'));
   }

   public function del_lesson_modul()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $gas = $this->db->delete('lesson_modul');
        if ($gas) {
         echo json_encode(array('status' => 'success', 'message' => 'Data Modul berhasil dihapus'));
         } else {
         echo json_encode(array('status' => 'error', 'message' => 'Data Modul gagal dihapus'));
         }
   }
// learnmodul
	public function learnmodul()
	{
		$data['pages'] 	= 'Dashboard Modul Course';
		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['announcement'] 	= $this->db->get('announcement')->row();
		$this->load->view('template/header');
		$this->load->view('admin/temp/head');
		$this->load->view('admin/temp/side');
		$this->load->view('admin/modul',$data);
		$this->load->view('template/footer');
	}
   public function fetch_lmodul()
   {
      $this->db->select('*');
      $query = $this->db->get('modul');
      $data = array();
      foreach ($query->result() as $kelas) {
         $data[] = array(
               'id'    => $kelas->id,
               'name'  => $kelas->name,
               'desc'  => $kelas->desc
         );
      }
      $response = array(
         'draw'            => intval($this->input->get('draw')),
         'recordsTotal'    => $this->db->count_all('modul'), 
         'recordsFiltered' => $this->db->count_all_results('modul'), 
         'data'            => $data 
      );

      // Kirimkan response dalam format JSON
      echo json_encode($response);
   }
   public function add_lmodul()
   {
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->insert('modul', $data);
        echo json_encode(array('status' => 'success', 'message' => 'Data modul berhasil ditambahkan'));
   }
   public function edit_lmodul()
   {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->where('id', $id);
        if ($this->db->update('modul', $data)) {
         echo json_encode(array('status' => 'success', 'message' => 'Data modul berhasil diperbarui'));
        }else{
         echo json_encode(array('status' => 'errorr', 'message' => 'Data modul berhasil diperbarui'));
        }
   }
   public function delete_lmodul()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('modul');
        echo json_encode(array('status' => 'success', 'message' => 'Data modul berhasil dihapus'));
   }
// learnmateri
	public function learnmateri()
	{
		$data['pages'] 	= 'Dashboard Materi Course';
		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['announcement'] 	= $this->db->get('announcement')->row();
		$this->load->view('template/header');
		$this->load->view('admin/temp/head');
		$this->load->view('admin/temp/side');
		$this->load->view('admin/materi',$data); // chapter as materi
		$this->load->view('template/footer');
	}

   function modulselect(){
		$id=htmlspecialchars($this->input->get('id'));
		if ($id == "") {
	        if ($get = $this->db->get('modul')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }else{
         $this->db->select('*');
         $this->db->like('name',$id);
	    	if ($get = $this->db->get('modul')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }
        echo json_encode($data);
	}

   public function getDetailMateri()
   {
      $materi_id = $this->input->post('materi_id');
      $materi = $this->db->get_where('chapter', ['id' => $materi_id])->row_array();

      // Ambil data pembahasan (discuss)
      $this->db->where('materi_id', $materi_id);
      $discuss = $this->db->get('discuss')->result_array();

      // Ambil data soal (quiz)
      $this->db->where('materi_id', $materi_id);
      $quiz = $this->db->get('quiz')->result_array();

      if ($materi) {
         $response = [
               'status' => 'success',
               'materi' => $materi,
               'discuss' => $discuss,
               'quiz' => $quiz
         ];
      } else {
         $response = [
               'status' => 'error',
               'message' => 'Materi tidak ditemukan'
         ];
      }

      echo json_encode($response);
   }

   public function saveDiscuss()
   {
      $id = $this->input->post('id');
      $materi_id = $this->input->post('materi_id');
      $name = $this->input->post('name');
      $desc = $this->input->post('desc');
      $link = $this->input->post('link');
      $typelink = $this->input->post('typelink');

      $upload_path = FCPATH . 'assets/learning/uploads/pembahasan/';
      $old_umask = umask(0);
      if (!is_dir($upload_path)) {
         mkdir($upload_path, 0777, true);
      }
      umask($old_umask);

      $file_names = [];
      $file_paths = [];

      // Check if 'foto' is an array or a single file
      if (!empty($_FILES['foto']['name'])) {
         // If it's an array (multiple files), loop through each one
         if (is_array($_FILES['foto']['name'])) {
            $count = count($_FILES['foto']['name']);
            for ($i = 0; $i < $count; $i++) {
               if (!empty($_FILES['foto']['name'][$i])) {
                  $_FILES['file']['name'] = $_FILES['foto']['name'][$i];
                  $_FILES['file']['type'] = $_FILES['foto']['type'][$i];
                  $_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
                  $_FILES['file']['error'] = $_FILES['foto']['error'][$i];
                  $_FILES['file']['size'] = $_FILES['foto']['size'][$i];

                  $config['upload_path'] = $upload_path;
                  $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
                  $config['max_size'] = 8192; // 8MB
                  $config['file_name'] = time() . '_' . $_FILES['foto']['name'][$i]; // Unique file name for each file

                  $this->upload->initialize($config);

                  if ($this->upload->do_upload('file')) {
                     $upload_data = $this->upload->data();
                     $file_names[] = $upload_data['file_name']; // Collect filenames
                     $file_paths[] = 'assets/learning/uploads/pembahasan/' . $upload_data['file_name']; // Collect file paths
                  } else {
                     $data['errors'][$i] = $this->upload->display_errors(); // Store errors for each file
                  }
               }
            }
         } else {
            // If it's a single file, handle it separately
            $_FILES['file'] = $_FILES['foto']; // Single file upload

            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
            $config['max_size'] = 8192; // 8MB
            $config['file_name'] = time() . '_' . $_FILES['file']['name']; // Unique file name for the single file

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
               $upload_data = $this->upload->data();
               $file_names[] = $upload_data['file_name']; // Collect filenames
               $file_paths[] = 'assets/learning/uploads/pembahasan/' . $upload_data['file_name']; // Collect file paths
            } else {
               $data['errors'] = $this->upload->display_errors(); // Store errors for the single file
            }
         }
      }

      // Check if any file or link is provided
      if (empty($file_names) && (empty($link) || empty($typelink))) {
         echo json_encode(['status' => 'error', 'message' => 'Harus mengisi salah satu: Upload file atau Link & Typelink']);
         return;
      }

      // If `id` is provided, update data
      if (!empty($id)) {
         $query = "UPDATE discuss SET 
                     name = ?,
                     `desc` = ?,
                     link = ?,
                     typelink = ?,
                     filepath = ?,
                     filename = ?
                     WHERE id = ?";
         $params = [$name, $desc, $link, $typelink, implode(',', $file_paths), implode(',', $file_names), $id]; // Save multiple file paths and names as a comma-separated string
      } else {
         // Insert new data if `id` is empty
         $query = "INSERT INTO discuss (materi_id, name, `desc`, link, typelink, filepath, filename) 
                     VALUES (?, ?, ?, ?, ?, ?, ?)";
         $params = [$materi_id, $name, $desc, $link, $typelink, implode(',', $file_paths), implode(',', $file_names)];
      }

      $this->db->query($query, $params);

      if ($this->db->affected_rows() > 0) {
         echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
      } else {
         echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
      }
   }
   public function delete_lbahas()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('discuss');
        echo json_encode(array('status' => 'success', 'message' => 'Data Pembahasan berhasil dihapus'));
   }

   //quiz add
   public function save_quiz() {
      if ($this->input->server('REQUEST_METHOD') !== 'POST') {
          show_404();
      }

      $data = [
         'materi_id' => $this->input->post('materi_id', true),
          'question' => $this->input->post('question', true),
          'ans_1' => $this->input->post('ans_1', true),
          'val_1' => $this->input->post('val_1', true),
          'ans_2' => $this->input->post('ans_2', true),
          'val_2' => $this->input->post('val_2', true),
          'ans_3' => $this->input->post('ans_3', true),
          'val_3' => $this->input->post('val_3', true),
          'ans_4' => $this->input->post('ans_4', true),
          'val_4' => $this->input->post('val_4', true),
          'ans_5' => $this->input->post('ans_5', true),
          'val_5' => $this->input->post('val_5', true),
      ];

      // Insert data ke database
      $insert = $this->db->insert('quiz', $data);

      // Cek hasil insert
      if ($insert) {
          echo json_encode(['success' => true, 'message' => 'Quiz berhasil disimpan!']);
      } else {
          echo json_encode(['success' => false, 'message' => 'Gagal menyimpan quiz.']);
      }
   }
   public function delete_lquiz()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('quiz');
        echo json_encode(array('status' => 'success', 'message' => 'Data Pembahasan berhasil dihapus'));
   }
   
   public function fetch_lmateri()
   {
      $this->db->select('chapter.id, chapter.name, chapter.desc, modul.name as modul,modul.id as modul_id');
      $this->db->from('chapter');
      $this->db->join('modul', 'modul.id = chapter.modul_id', 'left');
      $query = $this->db->get();
      $data = $query->result_array();

      $totalRecords = $this->db->count_all('chapter');
      $this->db->select('COUNT(*) as total');
      $this->db->from('chapter');
      $this->db->join('modul', 'modul.id = chapter.modul_id', 'left');
      $filteredRecords = $this->db->get()->row()->total;

      $response = array(
         'draw'            => intval($this->input->get('draw')),
         'recordsTotal'    => $totalRecords, 
         'recordsFiltered' => $filteredRecords, 
         'data'            => $data 
      );
      echo json_encode($response);
   }

   public function add_lmateri()
   {
        $name = $this->input->post('name');
        $modul = $this->input->post('modul');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'modul_id' => $modul,
            'desc' => $desc
        );
        $this->db->insert('chapter', $data);
        echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil ditambahkan'));
   }
   public function edit_lmateri()
   {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $modul = $this->input->post('modul');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'modul_id' => $modul,
            'desc' => $desc
        );
        $this->db->where('id', $id);
        if ($this->db->update('chapter', $data)) {
         echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil diperbarui'));
        }else{
         echo json_encode(array('status' => 'errorr', 'message' => 'Data kelas berhasil diperbarui'));
        }
   }
   public function delete_lmateri()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('chapter');
        echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil dihapus'));
   }
   function userselect(){
		$id=htmlspecialchars($this->input->get('id'));
		if ($id == "") {
	        if ($get = $this->db->get('user')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }else{
         $this->db->select('*');
         $this->db->like('name',$id);
	    	if ($get = $this->db->get('user')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }
        echo json_encode($data);
	}
   function lessonselect(){
		$id=htmlspecialchars($this->input->get('id'));
		if ($id == "") {
	        if ($get = $this->db->get('lesson')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }else{
         $this->db->select('*');
         $this->db->like('name',$id);
	    	if ($get = $this->db->get('lesson')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }
        echo json_encode($data);
	}
   
   public function add_user_kelas()
   {
      $modul_id = $this->input->post('idmodul');
      $lesson_id = $this->input->post('lesson_id');

      // Cek apakah kombinasi modul_id dan lesson_id sudah ada
      $exists = $this->db->get_where('lc_access', [
         'modul_id' => $modul_id,
         'lesson_id' => $lesson_id
      ])->row();

      if ($exists) {
         echo json_encode(array('status' => 'error', 'message' => 'Kombinasi modul sudah ada!'));
         return;
      }

      // Jika belum ada, insert data baru
      $data = array(
         'modul_id' => $modul_id,
         'lesson_id' => $lesson_id
      );

      $this->db->insert('lc_access', $data);
      echo json_encode(array('status' => 'success', 'message' => 'Data modul berhasil ditambahkan'));
   }
// AKSES MP
   public function aksesmp() {
		$data['pages'] 	= 'Akses Main Page';
		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['announcement'] 	= $this->db->get('announcement')->row();
		$this->load->view('template/header');
		$this->load->view('admin/temp/head');
		$this->load->view('admin/temp/side');
		$this->load->view('admin/aksesmp',$data); // chapter as materi
		$this->load->view('template/footer');
   }
   public function fetch_mpakses()
   {
      $this->db->select('mp_access.*,jabatan.name name, main_page.name desc');
      $this->db->from('mp_access');
      $this->db->join('jabatan', 'jabatan.id = mp_access.jabatan_id', 'left');
      $this->db->join('main_page', 'main_page.id = mp_access.mainpage_id', 'left');
      $this->db->order_by('jabatan.name', 'ASC');
      $query = $this->db->get();
      $data = $query->result_array();

      $totalRecords = $this->db->count_all('chapter');
      $this->db->select('COUNT(*) as total');
      $this->db->from('chapter');
      $this->db->join('modul', 'modul.id = chapter.modul_id', 'left');
      $filteredRecords = $this->db->get()->row()->total;

      $response = array(
         'draw'            => intval($this->input->get('draw')),
         'recordsTotal'    => $totalRecords, 
         'recordsFiltered' => $filteredRecords, 
         'data'            => $data 
      );
      echo json_encode($response);
   }
   function jabatanselect(){
		$id=htmlspecialchars($this->input->get('id'));
		if ($id == "") {
	        if ($get = $this->db->get('jabatan')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }else{
         $this->db->select('*');
         $this->db->like('name',$id);
	    	if ($get = $this->db->get('jabatan')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }
        echo json_encode($data);
	}
   function main_pageselect(){
		$id=htmlspecialchars($this->input->get('id'));
		if ($id == "") {
	        if ($get = $this->db->get('main_page')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }else{
         $this->db->select('*');
         $this->db->like('name',$id);
	    	if ($get = $this->db->get('main_page')->result_array()) {
		        	$data = array(
		        	'res' => 'ada',
		        	'items' => $get
		        );
	        }else{
	        	$data = array(
	        	'res' => 'tidak ada',
	        	'post' => 'eror'
	        	);
	        }
	    }
        echo json_encode($data);
	}
   
   public function add_jabatan_mp()
   {
      $modul_id = $this->input->post('idmodul');
      $lesson_id = $this->input->post('lesson_id');

      // Cek apakah kombinasi modul_id dan lesson_id sudah ada
      $exists = $this->db->get_where('mp_access', [
         'jabatan_id' => $modul_id,
         'mainpage_id' => $lesson_id
      ])->row();

      if ($exists) {
         echo json_encode(array('status' => 'error', 'message' => 'Kombinasi modul sudah ada!'));
         return;
      }

      // Jika belum ada, insert data baru
      $data = array(
         'jabatan_id' => $modul_id,
         'mainpage_id' => $lesson_id
      );

      $this->db->insert('mp_access', $data);
      echo json_encode(array('status' => 'success', 'message' => 'Data berhasil ditambahkan'));
   }
   
   public function delete_mpakses()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('mp_access');
        echo json_encode(array('status' => 'success', 'message' => 'Data akses berhasil dihapus'));
   }



}
