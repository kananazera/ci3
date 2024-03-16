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

	public function logout()
	{
		$this->session->unset_userdata('authenticated');
		$this->session->unset_userdata('auth_user');
		$this->session->set_flashdata('success', $this->lang->line('logout_success'));
		redirect(base_url());
	}
}
