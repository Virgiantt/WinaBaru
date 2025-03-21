<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SoalModel extends CI_Model
{
    public function getSoal($chapter_id)
    {
        return $this->db->get_where('quiz', ['materi_id' => $chapter_id])->result();
    }
}
