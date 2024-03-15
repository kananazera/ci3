<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');

		if ($this->session->has_userdata('authenticated')) {
			redirect(base_url());
		}
	}

	public function index()
	{
		$header['title'] = $this->lang->line('login');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('auth/login');
		$this->load->view('layouts/footer');
	}

	public function login()
	{
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$data['email'] = $this->input->post('email');
			$data['password'] = $this->input->post('password');

			$user = new UserModel;
			$result = $user->login($data);

			if ($result != false) {
				$this->session->set_userdata('authenticated', true);
				$this->session->set_userdata('auth_user', $result);
				$this->session->set_flashdata('success', $this->lang->line('login_success'));
				redirect(base_url());
			} else {
				$this->session->set_flashdata('error', $this->lang->line('login_error'));
				redirect(base_url('login'));
			}
		}
	}
}
