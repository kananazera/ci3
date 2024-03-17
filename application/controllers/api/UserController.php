<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
	}

	public function index()
	{
		$user = new UserModel;
		$users = $user->getAllActiveUsers();
		$this->response(100, 'List of all active users', $users, 200);
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
