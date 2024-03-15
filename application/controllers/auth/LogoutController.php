<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LogoutController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('authenticated')) {
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		$header['title'] = $this->lang->line('profile');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('user/profile');
		$this->load->view('layouts/footer');
	}

	public function update()
	{
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {

		}
	}
}
