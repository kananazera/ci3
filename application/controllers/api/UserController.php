<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->helper('api_helper');
	}

	public function index()
	{
		$users = $this->UserModel->getAllActiveUsers();
		$api_helper = new \helpers\api_helper;
		$api_helper->response(100, 'List of all active users', $users, 200);
	}

	public function create()
	{
		echo 'create';
	}

	public function edit($id)
	{
		echo 'edit: ' . $id;
	}

	public function delete($id)
	{
		echo 'delete: ' . $id;
	}
}
