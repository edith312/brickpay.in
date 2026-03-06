<?php

class Login_model extends CI_Model
{

    // Shiv Web Developer
    public function validate($username, $password)
    {
        $query = $this->db->get_where('admin_login', array('username' => $username, 'password' => $password));
        return $query->row_array();
    }

    public function updatepass($data, $table)
    {
        $query = $this->db->update($table, $data);
    }

    public function fetchall($table, $id)
    {
        $this->db->select('*');
        $this->db->where('admin_id', $id);
        $query = $this->db->get($table, $id);
        return $query->result_array();
    }
}
// Shiv Web Developer