<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
		$this->load->model('ProductImageModel');
		$this->load->model('CurrencyModel');
		$this->load->model('BlogModel');
		$this->load->helper('product');
	}

	public function index()
	{
		$header['title'] = $this->lang->line('home');
		$footer['pages'] = $this->PageModel->getPages($this->session->userdata('lang'));

		$data['last_products'] = $this->ProductModel->getLastProducts();
		$data['discount_products'] = $this->ProductModel->getDiscountProducts();
		$data['last_blog'] = $this->BlogModel->getLastBlog();

		$this->load->view('layouts/header', $header);
		$this->load->view('home/index', $data);
		$this->load->view('layouts/footer', $footer);
	}
}
