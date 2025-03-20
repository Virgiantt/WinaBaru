<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	function getmainmenu() {
		$id 	= $_SESSION['id_jabatan'];
		
		$query 	= "SELECT id_akses_dashboard,tbl_akses_dashboard.id_dashboard,id_jabatan,tbl_dashboard.urutan_menu FROM tbl_akses_dashboard LEFT JOIN tbl_dashboard ON tbl_akses_dashboard.id_dashboard = tbl_dashboard.id_dashboard WHERE id_jabatan='$id' ORDER BY tbl_dashboard.urutan_menu ASC";
		return $this->db->query($query)->result();
	}
}