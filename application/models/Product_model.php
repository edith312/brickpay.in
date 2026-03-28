<?php 

class Product_model extends CI_Model
{
    public function getProducts($page, $user_id = null, $limit = 12, $query = null)
    {
        $offset = $limit * $page;

        $this->db->select('
            p.*,
            (
                SELECT image 
                FROM tbl_product_images 
                WHERE product_id = p.id 
                ORDER BY id ASC 
                LIMIT 1
            ) as gallery_image,

            IFNULL(AVG(r.rating), 0) as avg_rating,
            COUNT(r.id) as review_count,

            (CASE 
                WHEN w.product_id IS NOT NULL THEN 1
                ELSE 0
            END) as wishlist_status
        ', FALSE);

        $this->db->from('products p');

        $this->db->join(
            'tbl_wishlist w',
            'w.product_id = p.id AND w.user_id = '.$this->db->escape($user_id),
            'left',
            FALSE
        );

        $this->db->join('tbl_reviews r', 'r.product_id = p.id', 'left', FALSE);

        if($query){
            $this->db->like('p.name', $query, 'both');
        }

        $this->db->group_by('p.id');

        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function getMyProducts($page, $user_id, $limit = 12, $query = null){

        $offset = $limit * $page;

        $this->db->select('
            p.*,
            (
                SELECT image 
                FROM tbl_product_images 
                WHERE product_id = p.id 
                ORDER BY id ASC 
                LIMIT 1
            ) as gallery_image,

            IFNULL(AVG(r.rating), 0) as avg_rating,
            COUNT(r.id) as review_count,

            (CASE 
                WHEN w.product_id IS NOT NULL THEN 1
                ELSE 0
            END) as wishlist_status
        ', FALSE);

        $this->db->from('products p');

        $this->db->join(
            'tbl_wishlist w',
            'w.product_id = p.id AND w.user_id = '.$this->db->escape($user_id),
            'left',
            FALSE
        );

        $this->db->join('tbl_reviews r', 'r.product_id = p.id', 'left', FALSE);
        $this->db->where('p.user_id', $user_id);
        if($query){
            $this->db->like('p.name', $query, 'both');
        }
        $this->db->group_by('p.id');

        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result_array();

    }

    public function getProductById($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('tbl_products')
            ->row_array();
    }

    public function getProductImages($product_id)
    {
        return $this->db
            ->where('product_id', $product_id)
            ->get('product_images')
            ->result_array();
    }

    public function getProductWithImages($id)
    {
        $product = $this->getProductById($id);

        if ($product) {
            $product['images'] = $this->getProductImages($id);
        }

        return $product;
    }

    public function insertProductImage($data)
    {
        return $this->db->insert('product_images', $data);
    }

    public function insertProduct($data)
    {
        $this->db->insert('tbl_products', $data);
        return $this->db->insert_id();
    }

    public function updateProduct($id, $user_id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        return $this->db->update('tbl_products', $data);
    }
}