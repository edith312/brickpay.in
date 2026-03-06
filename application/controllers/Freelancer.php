<?php
class Freelancer extends CI_Controller
// Shiv Web Developer
{
    public function registration()
    {
        $data['title'] = '';
        $this->load->view('freelancer/registration');
    }

    public function applied_task()
    {
        $data['title'] = '';
        $this->load->view('freelancer/applied_task');
    }
    public function available_task()
    {
        $data['title'] = '';
        $this->load->view('freelancer/available_task');
    }

    public function dashboard()
    {
        $data['title'] = '';
        $this->load->view('freelancer/dashboard');
    }

    public function freelancer_login(): void
    {
        $data['title'] = '';
        $this->load->view('freelancer/freelancer_login');
    }
    public function my_wallet(): void
    {
        $data['title'] = '';
        $this->load->view('freelancer/my_wallet');
    }

    public function freelancer_notification(): void
    {
        $data['title'] = '';
        $this->load->view('freelancer/freelancer_notification');
    }
}

// @ Shiv Web Developer