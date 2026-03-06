<?php
class ChatModel extends CI_Model
{


    function insertRowReturnId($table, $post)
    {
        $clean_post = $this->security->xss_clean($post);
        $this->db->insert($table, $clean_post);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }


    public function getSingleRowById($table, $where)
    {
        $get = $this->db->select()
            ->from($table)
            ->where($where)
            ->get();
        if ($get->num_rows() > 0) {
            return $get->row_array();
        } else {
            return false;
        }
    }


    public function getAllRows($table)
    {
        $get = $this->db->select()
            ->from($table)
            ->get();
        if ($get->num_rows() > 0) {
            return $get->result_array();
        } else {
            return false;
        }
    }


    public function get_or_create_room($user1, $user2)
    {
        $user1 = (int) $user1;
        $user2 = (int) $user2;

        if ($user1 <= 0 || $user2 <= 0) {
            return false;
        }

        $this->db
            ->group_start()
                ->where('user_one', $user1)
                ->where('user_two', $user2)
            ->group_end()
            ->or_group_start()
                ->where('user_one', $user2)
                ->where('user_two', $user1)
            ->group_end();

        $room = $this->db->get('tbl_chat_rooms')->row();

        if ($room) {
            return (int) $room->id;
        }

        $this->db->insert('tbl_chat_rooms', [
            'user_one' => $user1,
            'user_two' => $user2
        ]);

        return (int) $this->db->insert_id();
    }



    // Function End
}
// Shiv Web Developer