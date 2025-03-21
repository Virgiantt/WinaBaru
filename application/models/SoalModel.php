<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SoalModel extends CI_Model
{
    public function get_all_soal()
    {
        return $this->db->select('question, opt_1, opt_2, opt_3, opt_4, opt_5, ans_1, ans_2, ans_3, ans_4, ans_5')
            ->from('quiz')
            ->get()
            ->result();
    }
}
