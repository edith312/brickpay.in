<?php

class Cart_model extends CI_Model
{
    public function get_cart($user_id)
    {
        return $this->db
            ->select('c.*, p.name, p.image')
            ->from('cart c')
            ->join('tbl_products p', 'p.id = c.product_id')
            ->where('c.user_id', $user_id)
            ->get()
            ->result_array();
    }

    public function add_to_cart($data)
    {
        $exists = $this->db
            ->where('user_id', $data['user_id'])
            ->where('product_id', $data['product_id'])
            ->get('cart')
            ->row();

        if ($exists) {
            $this->db->set('quantity', 'quantity+1', false);
            $this->db->where('id', $exists->id);
            return $this->db->update('cart');
        } else {
            return $this->db->insert('cart', $data);
        }
    }

    public function update_qty($id, $qty)
    {
        return $this->db
            ->where('id', $id)
            ->update('cart', ['quantity' => $qty]);
    }

    public function remove_item($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete('cart');
    }

    public function cart_count($user_id = null)
    {
        if ($user_id) {
            $this->db->where('user_id', $user_id);
        }
        return $this->db->count_all_results('cart');
    }
}