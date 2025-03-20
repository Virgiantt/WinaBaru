<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LatihanModel extends CI_Model
{
    public function get_all_pelatihan()
    {
        return $this->db->get('lesson')->result();
    }
}
