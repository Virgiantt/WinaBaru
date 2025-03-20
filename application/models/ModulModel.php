<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModulModel extends CI_Model
{
    public function get_all_modul()
    {
        return $this->db->get('modul')->result();
    }
}
