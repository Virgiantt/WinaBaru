<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MateriModel extends CI_Model
{
    public function get_all_materi()
    {
        $this->db->select('
            modul.name as modul_name, 
            chapter.id as chapter_id, 
            chapter.name as chapter_name, 
            chapter.desc
        ');
        $this->db->from('chapter');
        $this->db->join('modul', 'modul.id = chapter.modul_id', 'left');
        return $this->db->get()->result();
    }

    public function get_discuss_by_chapter($chapter_id)
    {
        $this->db->select('*');
        $this->db->from('discuss');
        $this->db->where('chapter_id', $chapter_id);
        $query = $this->db->get();

        // Debugging
        echo "QUERY: " . $this->db->last_query();
        print_r($query->result());
        exit;

        return $query->result();
    }
}
