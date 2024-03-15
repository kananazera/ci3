<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegisterController extends MY_Controller
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
		$header['title'] = $this->lang->line('register');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
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

			$user = new UserModel;
			$register = $user->insert($data);

			if ($register) {
				$user_data['email'] = $email;
				$user_data['password'] = $password;

				$user = new UserModel;
				$result = $user->login($user_data);

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

}
