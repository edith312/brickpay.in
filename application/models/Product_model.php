<?php 

class Product_model extends CI_Model
{
    public function getProducts($page, $user_id = null){

        $limit = 10;
        $offset = $limit * $page;

        $this->db->select('
            p.*,
            IFNULL(AVG(r.rating), 0) as avg_rating,
            COUNT(r.id) as review_count,
            (CASE 
                WHEN w.product_id IS NOT NULL THEN 1
                ELSE 0
            END) as wishlist_status
        ', FALSE);

        $this->db->from('products p');

        // ✅ wishlist join
        $this->db->join('tbl_wishlist w', 'w.product_id = p.id AND w.user_id = '.$this->db->escape($user_id), 'left', FALSE);

        // ✅ review join
        $this->db->join('tbl_reviews r', 'r.product_id = p.id', 'left', FALSE);

        $this->db->group_by('p.id');

        // $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMyProducts($page, $user_id){

        $limit = 10;
        $offset = $limit * $page;

        $this->db->select('p.*');
        $this->db->select('
            (CASE 
                WHEN w.product_id IS NOT NULL THEN 1
                ELSE 0
            END) as wishlist_status
        ', FALSE);
        $this->db->from('products p');
        $this->db->join('tbl_wishlist w', 'w.product_id = p.id', 'left', FALSE);
        $this->db->where('p.user_id', $user_id);
        // $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result_array();
    }
}