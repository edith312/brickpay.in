<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserReport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserReportModel');
        $this->load->library('session');
    }

    public function index()
    {
        if (!sessionId('freelancer_id')) {
            redirect(base_url(''));
        }

        $user_id = sessionId('freelancer_id');
        if (!$user_id) {
            show_error('User  not logged in', 403);
        }

        $db_size = $this->UserReportModel->get_user_db_size($user_id);
        $file_size = $this->UserReportModel->get_user_files_size_from_db($user_id);

        $data = [
            'db_size' => $db_size,
            'file_size' => $file_size,
            'total_size' => $db_size + $file_size
        ];

        $data['title'] = 'User Data Occupied';
        $this->load->view('includes/header-link', $data);
        $this->load->view('user_storage_report');
    }
}
