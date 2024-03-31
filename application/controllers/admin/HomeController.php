<?php

class HomeController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('CategoryModel');
		$this->load->model('ProductModel');
		$this->load->model('ContactMessageModel');
		$this->load->model('OrderModel');
		$this->lang->load('control_panel', $this->session->userdata('lang'));

		if (!$this->session->has_userdata('authenticated')) {
			redirect(base_url('login'));
		}

		if ($this->UserModel->show($this->session->userdata('auth_user')->id)->is_admin != 1) {
			redirect(base_url('403'));
		}
	}

	public function index()
	{
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/index');
		$this->load->view('admin/layouts/footer');
	}
}
