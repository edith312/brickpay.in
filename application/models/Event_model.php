<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends CI_Model
{
    protected $table = 'tbl_bricks';

    public function get_between($start, $end, $user_id, $company_id = null, $project_id = null)
    {
        // Adjust column name as per your DB (example: brick_datetime)
        $this->db->where("create_date >=", $start);
        $this->db->where("create_date <=", $end);
        $this->db->where("user_id =", $user_id);

        if($company_id){
            $this->db->where("company_id =", $company_id);
        }
        
        if($project_id){
            $this->db->where("project_id =", $project_id);
        }

        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}
