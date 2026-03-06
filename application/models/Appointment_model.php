<?php

class Appointment_model extends CI_Model {

    public function insert($data)
    {
        return $this->db->insert('appointments', $data);
    }

    public function check_conflict($company_id, $start, $end)
    {
        $this->db->where('company_id', $company_id);
        $this->db->where("status !=", "cancelled");

        $this->db->where("(
            ('$start' < end_datetime) AND
            ('$end' > start_datetime)
        )");

        return $this->db->get('appointments')->row();
    }
}