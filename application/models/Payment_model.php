<?php
class Payment_model extends CI_Model
{
    // Shiv Web Developer
    public function create_transaction($data)
    {
        $this->db->insert('transactions', $data);
        return $this->db->insert_id();
    }

    public function get_transaction($transaction_id)
    {
        return $this->db->get_where('transactions', array('id' => $transaction_id))->row();
    }

    public function update_transaction($transaction_id, $data)
    {
        $this->db->where('id', $transaction_id);
        $this->db->update('transactions', $data);
    }

    public function get_user_transactions($user_id)
    {
        return $this->db->get_where('transactions', array('user_id' => $user_id))->result();
    }
}

// Shiv Web Developer