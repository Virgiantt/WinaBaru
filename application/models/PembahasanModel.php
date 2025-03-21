<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembahasanModel extends CI_Model
{
    public function get_pembahasan_by_chapter($chapter_id)
    {
        return $this->db
            ->where('chapter_id', $chapter_id)
            ->order_by('id', 'ASC')
            ->get('discuss')
            ->result();
    }
    public function getMateri($chapter_id)
    {
        return $this->db->get_where('chapter', ['id' => $chapter_id])->row();
    }

    public function getPembahasan($chapter_id)
    {
        return $this->db->get_where('discuss', ['chapter_id' => $chapter_id])->result();
    }

    public function getSoal($chapter_id)
    {
        return $this->db->get_where('quiz', ['materi_id' => $chapter_id])->result();
    }
}
