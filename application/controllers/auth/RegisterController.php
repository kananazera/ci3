<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegisterController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('EmailVerifyTokenModel');
		$this->load->library('email');
		$this->load->helper('email_helper');

		if ($this->session->has_userdata('authenticated')) {
			redirect(base_url());
		}
	}

	public function index()
	{
		$header['title'] = $this->lang->line('register');

		$this->load->view('layouts/header', $header);
		$this->load->view('auth/register');
		$this->load->view('layouts/footer');
	}

	public function register()
	{
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|alpha');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'min_length[6]');
		$this->form_validation->set_rules('password_confirmation', $this->lang->line('password_confirmation'), 'matches[password]');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$data['name'] = $name;
			$data['email'] = $email;
			$data['password'] = md5($password);

			$register = $this->UserModel->insert($data);

			if ($register) {
				if ($this->config->item('send_email_verification_link') == true) {
					$this->sendEmailVerificationLink($email);
				}

				$user_data['email'] = $email;
				$user_data['password'] = $password;

				$result = $this->UserModel->login($user_data);

				$this->session->set_userdata('authenticated', true);
				$this->session->set_userdata('auth_user', $result);
				$this->session->set_flashdata('success', $this->lang->line('register_success'));
				redirect(base_url());
			} else {
				$this->session->set_flashdata('error', $this->lang->line('register_error'));
				redirect(base_url('register'));
			}

		}
	}

	public function sendEmailVerificationLink($email)
	{
		$token = md5($email . time());

		$data['email'] = $email;
		$data['token'] = $token;
		$data['date'] = date('Y-m-d');

		$this->EmailVerifyTokenModel->insert($data);
		$token_id = $this->db->insert_id();

		$link = base_url('email/verify/' . $token);

		$data_email['link'] = $link;

		$message = $this->load->view('email/verify', $data_email, true);

		$send = sendEmail($email, $this->lang->line('verify_email'), $message);

		if (!$send) {
			$this->EmailVerifyTokenModel->delete($token_id);
		}
	}
}
