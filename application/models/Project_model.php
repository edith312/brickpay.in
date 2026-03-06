<?php
class Project_model extends CI_Model
{
    public function create_project($data)
    {
        $this->db->insert('projects', $data);
        return $this->db->insert_id();
    }

    public function get_user_projects($user_id)
    {
        return $this->db->get_where('projects', array('user_id' => $user_id))->result();
    }

    public function update_project($project_id, $data)
    {
        $this->db->where('id', $project_id);
        $this->db->update('projects', $data);
    }
}

// Shiv Web Developer