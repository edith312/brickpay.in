<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GoogleTokenModel extends CI_Model
{

    // Shiv Web Developer
    private $table = 'tbl_user_google_tokens';

    public function __construct()
    {
        parent::__construct();
    }

    // Insert or update Google token + user info for a user
    public function saveTokenAndUserInfo($user_id, $google_id, $name, $email, $phone = null, $picture = null, $access_token, $refresh_token, $expires_in)
    {
        $token_expiry = date('Y-m-d H:i:s', time() + $expires_in);

        $data = [
            'google_id'     => $google_id,
            'name'          => $name,
            'email'         => $email,
            'phone'         => $phone,
            'picture'       => $picture,
            'access_token'  => $access_token,
            'refresh_token' => $refresh_token,
            'token_expiry'  => $token_expiry,
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        // Check if user record exists
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            // Update existing record
            $this->db->where('user_id', $user_id);
            return $this->db->update($this->table, $data);
        } else {
            // Insert new record
            $data['user_id'] = $user_id;
            $data['created_at'] = date('Y-m-d H:i:s');
            return $this->db->insert($this->table, $data);
        }
    }

    // Get token + user info for a user
    public function getTokenAndUserInfo($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }
}


// Shiv Web Developer