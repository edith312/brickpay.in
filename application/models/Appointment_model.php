<?php

class Appointment_model extends CI_Model {

    public function insert($data)
    {
        return $this->db->insert('appointments', $data);
    }

    // public function check_conflict($company_id, $start, $end)
    // {
    //     $this->db->where('company_id', $company_id);
    //     $this->db->where("status !=", "cancelled");

    //     $this->db->where("(
    //         ('$start' < end_datetime) AND
    //         ('$end' > start_datetime)
    //     )");

    //     return $this->db->get('appointments')->row();
    // }

    public function check_conflict($start, $end, $company_id = null, $booked_user_id = null)
    {
        $this->db->where("status !=", "cancelled");

        // COMPANY CONFLICT
        if ($company_id) {
            $this->db->where('company_id', $company_id);
        }

        // USER CONFLICT
        if ($booked_user_id) {
            $this->db->where('booked_user_id', $booked_user_id);
        }

        // TIME OVERLAP CHECK
        $this->db->where("(
            ('$start' < end_datetime) AND
            ('$end' > start_datetime)
        )");

        $query = $this->db->get('appointments');

        return $query->num_rows() > 0;
    }
}