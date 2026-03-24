<?php

class Wishlist_model extends CI_Model {
    public function get_wishlist($user_id = null) {
        if($user_id){
            $this->db->select('p.*', FALSE);
            $this->db->select('
                (CASE 
                    WHEN w.product_id IS NOT NULL THEN 1
                    ELSE 0
                END) as wishlist_status
            ', FALSE);
            $this->db->from('wishlist w');
            $this->db->join('products p', 'w.product_id = p.id', FALSE);
            $this->db->where('w.user_id', $user_id);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
}