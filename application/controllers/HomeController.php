<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends MY_Controller
{
	public function index()
	{
		$header['title'] = $this->lang->line('home');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('home/index');
		$this->load->view('layouts/footer');
	}
}
