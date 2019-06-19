<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function countUser()
    {
        $count = $this->db->count_all('user');
        return $count;
    }

    // public function countGuru()
    // {
    //     $count = $this->db->get_where('user',['jabatan' => 'Guru'])->num_rows();
    //     return  $count;
    // }

    public function getAllUser()
    {
        $count = $this->db->get('user');
        return $count;
    }

    public function getUserByID($id)
    {
        $count = $this->db->get_where('user', ['id' => $id]);
        return $count;
    }

    public function addUser($data)
    {
        $add = $this->db->insert('user', $data);
        return $add;
    }

    public function delUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}
