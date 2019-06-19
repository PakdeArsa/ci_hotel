<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_model extends CI_Model
{

    public function countDosen()
    {
        $count = $this->db->count_all('tbl_dosen');
        return $count;
    }

    public function getAllDosen()
    {
        $count = $this->db->get('tbl_dosen');
        return $count;
    }

    public function getDosenByID($id)
    {
        $count = $this->db->get_where('tbl_dosen', ['id' => $id]);
        return $count;
    }

    public function addDosen($data)
    {
        $add = $this->db->insert('tbl_dosen', $data);
        return $add;
    }

    public function delDosen($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_dosen');
    }
}
