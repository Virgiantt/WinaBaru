<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SessionHook {
    public function checkSessionStatus() {
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->library('session');

        $username = $CI->session->userdata('username');

        if ($username) {
            $CI->db->update('tbl_user', ['last_active' => date('Y-m-d H:i:s')], ['username' => $username]);
        } else {
            $inactiveLimit = date('Y-m-d H:i:s', strtotime('-2 hours'));
            $CI->db->where('last_active <=', $inactiveLimit);
            $CI->db->update('tbl_user', ['is_logged_in' => 0]);
        }
    }
}
