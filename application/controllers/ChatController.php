<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChatController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ChatModel');
        $this->load->library('session');
    }

    // public function index()
    // {
    //     if (!sessionId('freelancer_id')) {
    //         redirect(base_url(''));
    //     }

    //     $data['title'] = "Let's Chat";
    //     $this->load->view('includes/header-link', $data);
    //     $this->load->view('chat/index');
    // }

    public function chat_with_user()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $chat_with_user_id = $this->input->post('chat_with_user'); // 15
        $user_id = sessionId('freelancer_id');

        if (empty($chat_with_user_id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid User Selected'
            ]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $modified_date = date('Y-m-d H:i:s');

        $check = $this->ChatModel->getSingleRowById(
            'tbl_chat',
            [
                'user_id' => $user_id,
                'chat_with_user_id' => $chat_with_user_id,
            ]
        );

        if ($check) {
            echo json_encode([
                'success' => false,
                'message' => 'User Already Added in Chat List'
            ]);
        } else {

            $data = [
                'user_id' => $user_id,
                'chat_with_user_id' => $chat_with_user_id,
                'created_date' => $modified_date,
                'updated_date' => null,
            ];

            $insert = $this->ChatModel->insertRowReturnId('tbl_chat', $data);

            echo json_encode([
                'success' => (bool)$insert,
                'message' => $insert
                    ? 'User Added in Chat List'
                    : 'Failed to Adding User in Chat List'
            ]);
        }
    }


    // GET ALREADY ADDED USERS WITH US IN PORTFOLIO
    public function get_chat_users()
    {
        $user_id = sessionId('freelancer_id');

        $sql = "
            SELECT f.id, f.name, f.email, f.phone, f.user_image
            FROM tbl_freelancer f
            JOIN (
                SELECT chat_with_user_id AS user_id
                FROM tbl_chat
                WHERE user_id = ?

                UNION

                SELECT user_id
                FROM tbl_chat
                WHERE chat_with_user_id = ?
            ) u ON u.user_id = f.id
        ";

        $query = $this->db->query($sql, [$user_id, $user_id]);

        $users = $query->result_array();

        $html = $this->load->view(
            'chat/user_list',
            ['users' => $users],
            true
        );

        echo json_encode([
            'success' => true,
            'html' => $html
        ]);
    }


    public function get_room()
    {
        $targetUser = $this->input->post('user_id');
        $currentUser = sessionId('freelancer_id');

        $roomId = $this->ChatModel->get_or_create_room($currentUser, $targetUser);

        $user = $this->db
            ->select('id, name, user_image')
            ->where('id', $targetUser)
            ->get('freelancer')
            ->row_array();
        
        echo json_encode([
            'success' => true,
            'room_id' => $roomId,
            'user' => $user
        ]);
    }

    public function get_messages()
    {
        $roomId = $this->input->post('room_id');

        $messages = $this->db
            ->where('chat_room_id', $roomId)
            ->order_by('id', 'ASC')
            ->get('chat_messages')
            ->result();

        echo json_encode(['success' => true, 'messages' => $messages]);
    }

    public function send_message()
    {
        if (!sessionId('freelancer_id')) {
            echo json_encode(['success' => false]);
            return;
        }

        $room_id = $this->input->post('room_id');
        $message = trim($this->input->post('message'));
        $sender  = sessionId('freelancer_id');

        if (!$room_id || !$message) {
            echo json_encode(['success' => false]);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');

        $data = [
            'chat_room_id' => $room_id,
            'sender_id' => $sender,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $insert = $this->db->insert('chat_messages', $data);

        echo json_encode([
            'success' => (bool)$insert
        ]);
    }


    // Controller End
}
