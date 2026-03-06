<?php

class AdminAuth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function admin()
	{
		if (sessionId('admin_id') != '') {
			redirect('admin/dashboard');
		} else {
			if (count($_POST) > 0) {
				$this->form_validation->set_rules('email_id', 'Email Id', 'required');
				$this->form_validation->set_rules('password', 'password', 'required');
				$this->form_validation->set_error_delimiters('<div style="color: red;">', '</div>');
				if ($this->form_validation->run()) {
					$phone = $this->input->post('email_id');
					$password = $this->input->post('password');
					$get = $this->CommonModal->getSingleRowById('admin_login', "email_id = '$phone'");
					if ($get) {
						$id = $get['admin_id'];
						$name = $get['name'];
						$f_password = $get['password'];
						$status = $get['status'];
						if ($password != $f_password) {
							flashData('login_error', 'Enter a valid Password.');
						} else if ($status == '0') {
							flashData('login_error', 'You are blocked.');
						} else if ($password == $f_password) {
							setSession(array(
								'admin_id' => $id,
								'admin_name' => $name,
							));
							redirect('admin/dashboard');
						} else {
							flashData('login_error', 'something went wrong');
						}
					} else {
						flashData('login_error', 'Incorrect email id or password.');
					}
				}
			}
			$this->load->view('admin/login');
		}
	}

	public function adminLogout()
	{
		$this->session->unset_userdata(['admin_id', 'admin_name']);
		redirect('admin');
	}

	public function deleteUser($id)
	{
		echo json_encode(['status' => false, 'message' => 'enter valid user id']);
	}
}
