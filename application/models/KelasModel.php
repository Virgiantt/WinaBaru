<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelasModel extends CI_Model
{
    public function get_kelas_by_user($user_id)
    {
        $this->db->select('learn_class.id, learn_class.name, learn_class.desc');
        $this->db->from('learn_class');
        $this->db->join('lc_access', 'lc_access.lc_id = learn_class.id');
        $this->db->where('lc_access.user_id', $user_id);

        $query = $this->db->get();
        return $query->result();
    }
}
