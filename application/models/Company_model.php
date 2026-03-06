<?php
class Company_model extends CI_Model
{
    public function create_company($data)
    {
        $this->db->insert('companies', $data);
        return $this->db->insert_id();
    }

    public function get_user_companies($user_id)
    {
        return $this->db->get_where('companies', array('user_id' => $user_id))->result();
    }

    public function update_company($company_id, $data)
    {
        $this->db->where('id', $company_id);
        $this->db->update('companies', $data);
    }
}
// Shiv Web Developer