<?php

defined('BASEPATH') or exit('No direct script access allowed');

class EmailVerifyController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('EmailVerifyTokenModel');
		$this->load->library('email');
		$this->load->helper('email_helper');
	}

	public function verify($token)
	{
		$get_token = $this->EmailVerifyTokenModel->get($token);
		$email = $get_token->email;
		$token_id = $get_token->id;

		$user_id = $this->UserModel->check($email)->id;

		if (!$email) {
			$this->session->set_flashdata('error', $this->lang->line('verify_email_invalid_link'));
			redirect(base_url());
		}

		$data['email_verified'] = date('Y-m-d H:i:s');

		$result = $this->UserModel->update($user_id, $data);

		if ($result > 0) {
			$updated_user_data = $this->UserModel->show($user_id);
			$this->session->set_userdata('auth_user', $updated_user_data);
			$this->EmailVerifyTokenModel->delete($token_id);
			$this->session->set_flashdata('success', $this->lang->line('verify_email_success'));
			redirect(base_url());
		} else {
			$this->session->set_flashdata('error', $this->lang->line('verify_email_error'));
			redirect(base_url());
		}
	}
}
