<?php
class User_model extends CI_Model
{
    public function create_user($data)
    {
        $this->db->insert('freelancer', $data);
        return $this->db->insert_id();
    }
    // Shiv Web Developer
    public function get_user($user_id)
    {
        return $this->db->get_where('freelancer', array('id' => $user_id))->row();
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('freelancer', array('email' => $email))->row();
    }

    public function update_user($user_id, $data)
    {
        $this->db->where('id', $user_id);
        $this->db->update('freelancer', $data);
    }
}
