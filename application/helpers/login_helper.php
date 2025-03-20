<?php
function is_logged_in() {
	$ci = get_instance();
	if(!$ci->session->userdata('username')) {
		redirect('auth');
	} else {
		$jabatan 	= $ci->session->userdata('id_jabatan');
		$menu 		= $ci->uri->segment(1);
		$queryMenu	= $ci->db->get_where('tbl_main_page',['url_main_page' => $menu])->row_array();
		$menu_id 	= $queryMenu['id_main_page'];

		$userAccess = $ci->db->get_where('tbl_akses_main_page',['id_jabatan' => $jabatan, 'id_main_page' => $menu_id]);

		if($userAccess->num_rows() < 1) {
			redirect('auth/blocked');
		}
	}
}

function check_view_menu() {
	$ci = get_instance();

	$jabatan 	= $ci->session->userdata('id_jabatan');
	$segment_1 	= $ci->uri->segment(1);
	$segment_2 	= $ci->uri->segment(2);
	$link 		= $segment_1."/".$segment_2;
	$menu 		= $link;
	$queryMenu	= $ci->db->get_where('tbl_menu',['url_menu' => $menu])->row_array();
	$menu_id 	= $queryMenu['id_menu'];

	$userAccess = $ci->db->get_where('tbl_akses_menu',['id_jabatan' => $jabatan, 'id_menu' => $menu_id]);

	if($userAccess->num_rows() < 1) {
		redirect('auth/blocked');
	}
}

function check_access($id_jabatan, $id_menu) {
	$ci = get_instance();

	$ci->db->where('id_jabatan', $id_jabatan);
	$ci->db->where('id_menu', $id_menu);
	$result = $ci->db->get('tbl_akses_menu');

	if($result->num_rows() > 0) {
		return 'checked="checked"';
	}
}

function get_menu_access($ci) {
        $url1  = $ci->uri->segment(1);
        $url2  = $ci->uri->segment(2);
        $url3  = $url1."/".$url2;
        $id_mn = "";
        $jabatan = $ci->session->userdata('id_jabatan');

        // Query untuk mendapatkan id_menu
        $query  = "SELECT id_menu FROM tbl_menu WHERE url_menu='$url3'";
        $data   = $ci->db->query($query)->result_array();
        foreach ($data as $dt) {
            $id_mn = $dt['id_menu'];
        }

        // Query untuk mendapatkan akses proses
        $query2 = "SELECT tbl_akses_proses.id_akses_proses, tbl_akses_proses.id_jabatan, tbl_akses_proses.id_proses, tbl_proses.id_menu, tbl_proses.nama_proses, tbl_proses.icon_proses, tbl_proses.url_proses, tbl_proses.urutan_proses, tbl_proses.prefix_proses FROM tbl_akses_proses INNER JOIN tbl_proses ON tbl_akses_proses.id_proses = tbl_proses.id_proses WHERE tbl_proses.id_menu = '$id_mn' AND tbl_akses_proses.id_jabatan = '$jabatan'";
        $data2  = $ci->db->query($query2)->result_array(); 
        return $data2;
}

function inpage() {
	$ci = get_instance();
	$jabatan 	= $ci->session->userdata('id_jabatan');
	$url1 		= $ci->uri->segment(1);
	$url2 		= $ci->uri->segment(2);
	$url 		= $url1 . '/' . $url2;
	$queryMenu	= $ci->db->get_where('tbl_menu',['url_menu' => $url])->row_array();
	$menu_id 	= $queryMenu['id_menu'];

	$userAccess = $ci->db->get_where('tbl_akses_menu',['id_jabatan' => $jabatan, 'id_menu' => $menu_id]);
	if($userAccess->row_array() < 1) {
		redirect('auth/blocked');
	}
}