<?php 

class Product_model extends CI_Model
{
    public function getProducts($page){

        $limit = 10;
        $offset = $limit * $page;

        $this->db->select('*');
        $this->db->from('products');
        // $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMyProducts($page, $user_id){

        $limit = 10;
        $offset = $limit * $page;

        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('user_id', $user_id);
        // $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result_array();
    }
}