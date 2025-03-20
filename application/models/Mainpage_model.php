<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainpage_model extends CI_Model {
	function get_list_menu() {
		$jabatan 	= $this->session->userdata('jabatan_id');
		$query 	= "SELECT main_page.* FROM	mp_access LEFT JOIN main_page	ON mp_access.mainpage_id = main_page.id WHERE mp_access.jabatan_id = '$jabatan'";
		return $this->db->query($query)->result();
	}
}