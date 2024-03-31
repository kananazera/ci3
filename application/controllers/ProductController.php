<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProductController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
		$this->load->model('ProductImageModel');
		$this->load->model('CurrencyModel');
		$this->load->model('CategoryModel');
		$this->load->model('PropertyValueModel');
		$this->load->model('PropertyModel');
		$this->load->model('CommentModel');
		$this->load->model('UserModel');
		$this->load->helper('product');
		$this->load->helper('date');
	}

	public function index($offset = 0)
	{
		$search = $this->input->post('search');

		$this->load->library('pagination');

		$config['base_url'] = base_url('products');
		if ($search) {
			$config['total_rows'] = $this->ProductModel->count($search);
		} else {
			$config['total_rows'] = $this->ProductModel->count();
		}
		$config['per_page'] = 12;
		$config['uri_segment'] = 2;

		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';

		$this->pagination->initialize($config);

		if ($search) {
			$data['products'] = $this->ProductModel->searchActiveProducts($search, $config['per_page'], $offset);
		} else {
			$data['products'] = $this->ProductModel->getActiveProducts($config['per_page'], $offset);
		}

		$header['title'] = $this->lang->line('products');
		$footer['pages'] = $this->PageModel->getPages($this->session->userdata('lang'));

		$this->load->view('layouts/header', $header);
		$this->load->view('products/index', $data);
		$this->load->view('layouts/footer', $footer);
	}

	public function product($slug, $offset = 0)
	{
		$product = $this->ProductModel->showBySlug($slug);

		if(!$product) {
			redirect(base_url());
		}

		$this->load->library('pagination');

		$config['base_url'] = base_url('product/' . $slug);
		$config['total_rows'] = $this->CommentModel->commentCount($product->id);
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;

		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';

		$this->pagination->initialize($config);

		$header['title'] = $product->title;
		$footer['pages'] = $this->PageModel->getPages($this->session->userdata('lang'));

		$data['product'] = $product;
		$data['properties'] = $this->PropertyValueModel->get($product->id);
		$data['images'] = $this->ProductImageModel->get($product->id);
		$data['comments'] = $this->CommentModel->getActiveComments($product->id, $config['per_page'], $offset);

		$this->load->view('layouts/header', $header);
		$this->load->view('products/view', $data);
		$this->load->view('layouts/footer', $footer);
	}

	public function writeComment($product_id)
	{
		$this->form_validation->set_rules('comment', $this->lang->line('comment'), 'required');

		if ($this->form_validation->run() == false) {
			$this->writeComment($product_id);
		} else {
			$product = $this->ProductModel->show($product_id);

			$comment = $this->input->post('comment');

			$data['product_id'] = $product_id;
			$data['user_id'] = $this->session->userdata('auth_user')->id;
			$data['comment'] = $comment;

			$insert = $this->CommentModel->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', $this->lang->line('comment_success'));
				redirect(base_url('product/' . $product->slug));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('comment_error'));
				redirect(base_url('product/' . $product->slug));
			}

		}

	}

	public function deleteComment($comment_id, $product_id)
	{
		$product = $this->ProductModel->show($product_id);
		$comment = $this->CommentModel->show($comment_id);

		if ($comment->user_id != $this->session->userdata('auth_user')->id) {
			redirect(base_url('product/' . $product->slug));
		}

		$this->CommentModel->delete($comment_id);

		redirect(base_url('product/' . $product->slug));
	}
}
