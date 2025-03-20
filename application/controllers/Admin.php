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
// DASHBOARD
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
// learnpembahasan
	public function learnpembahasan()
	{
		$data['pages'] 	= 'Dashboard Pembasan Course';
		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['announcement'] 	= $this->db->get('announcement')->row();
		$this->load->view('template/header');
		$this->load->view('admin/temp/head');
		$this->load->view('admin/temp/side');
		$this->load->view('admin/dash',$data);
		$this->load->view('template/footer');
	}
   
   public function fetch_lpembahasan($materi_id)
   {
      $this->db->select('*');
      $this->db->from('discuss');
      $this->db->where('materi_id',$materi_id);
      $query = $this->db->get();
      $data = array();
      foreach ($query->result() as $kelas) {
         $data[] = array(
               'id'    => $kelas->id,
               'name'  => $kelas->name,
               'desc'  => $kelas->desc,
               'link'  => $kelas->link,
               'typelink'  => $kelas->typelink,
               'filepath'  => $kelas->filepath,
               'filename'  => $kelas->filename,
               'materi_id'  => $kelas->materi_id
         );
      }
      $response = array(
         'draw'            => intval($this->input->get('draw')),
         'recordsTotal'    => $this->db->count_all('discuss'), 
         'recordsFiltered' => $this->db->count_all_results('discuss'), 
         'data'            => $data 
      );

      // Kirimkan response dalam format JSON
      echo json_encode($response);
   }
   public function add_lpembahasan()
   {
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->insert('discuss', $data);
        echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil ditambahkan'));
   }
   public function edit_lpembahasan()
   {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->where('id', $id);
        if ($this->db->update('discuss', $data)) {
         echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil diperbarui'));
        }else{
         echo json_encode(array('status' => 'errorr', 'message' => 'Data kelas berhasil diperbarui'));
        }
   }
   public function delete_lpembahasan()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('discuss');
        echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil dihapus'));
   }
// learnsoal
	public function learnsoal()
	{
		$data['pages'] 	= 'Dashboard Soal Course';
		$data['main_page'] 	= $this->m_model->get_list_menu();
		$data['announcement'] 	= $this->db->get('announcement')->row();
		$this->load->view('template/header');
		$this->load->view('admin/temp/head');
		$this->load->view('admin/temp/side');
		$this->load->view('admin/dash',$data);
		$this->load->view('template/footer');
	}
   
   public function fetch_lsoal($materi_id)
   {
      $this->db->select('*');
      $this->db->from('quiz');
      $this->db->where('materi_id',$materi_id);
      $query = $this->db->get('');
      $data = array();
      foreach ($query->result() as $kelas) {
         $data[] = array(
               'id'    => $kelas->id,
               'materi_id'  => $kelas->materi_id,
               'question'  => $kelas->question,
               'ans_1'  => $kelas->ans_1,
               'ans_2'  => $kelas->ans_2,
               'ans_3'  => $kelas->ans_3,
               'ans_4'  => $kelas->ans_4,
               'ans_5'  => $kelas->ans_5,
               'val_1'  => $kelas->val_1,
               'val_2'  => $kelas->val_2,
               'val_3'  => $kelas->val_3,
               'val_4'  => $kelas->val_4,
               'val_5'  => $kelas->val_5,
               'opt_1'  => $kelas->opt_1,
               'opt_2'  => $kelas->opt_2,
               'opt_3'  => $kelas->opt_3,
               'opt_4'  => $kelas->opt_4,
               'opt_5'  => $kelas->opt_5
         );
      }
      $response = array(
         'draw'            => intval($this->input->get('draw')),
         'recordsTotal'    => $this->db->count_all('quiz'), 
         'recordsFiltered' => $this->db->count_all_results('quiz'), 
         'data'            => $data 
      );

      // Kirimkan response dalam format JSON
      echo json_encode($response);
   }
   public function add_lsoal()
   {
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->insert('quiz', $data);
        echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil ditambahkan'));
   }
   public function edit_lsoal()
   {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $data = array(
            'name' => $name,
            'desc' => $desc
        );
        $this->db->where('id', $id);
        if ($this->db->update('quiz', $data)) {
         echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil diperbarui'));
        }else{
         echo json_encode(array('status' => 'errorr', 'message' => 'Data kelas berhasil diperbarui'));
        }
   }
   public function delete_lsoal()
   {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('quiz');
        echo json_encode(array('status' => 'success', 'message' => 'Data kelas berhasil dihapus'));
   }

}
