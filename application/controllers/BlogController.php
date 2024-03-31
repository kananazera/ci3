<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BlogController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BlogModel');
		$this->load->helper('date');
	}

	public function index($offset = 0)
	{
		$search = $this->input->post('search');

		$this->load->library('pagination');

		$config['base_url'] = base_url('blog');
		if ($search) {
			$config['total_rows'] = $this->BlogModel->count($search);
		} else {
			$config['total_rows'] = $this->BlogModel->count();
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
			$data['blog'] = $this->BlogModel->searchActiveBlog($search, $config['per_page'], $offset);
		} else {
			$data['blog'] = $this->BlogModel->getActiveBlog($config['per_page'], $offset);
		}

		$header['title'] = $this->lang->line('blog');
		$footer['pages'] = $this->PageModel->getPages($this->session->userdata('lang'));

		$this->load->view('layouts/header', $header);
		$this->load->view('blog/index', $data);
		$this->load->view('layouts/footer', $footer);
	}

	public function blog($slug)
	{
		$blog = $this->BlogModel->showBySlug($slug);
		$header['title'] = $blog->title;
		$footer['pages'] = $this->PageModel->getPages($this->session->userdata('lang'));

		$update_data['views'] = $blog->views + 1;;
		$this->BlogModel->update($blog->id, $update_data);

		$data['blog_view'] = $blog;
		$data['blog_random'] = $this->BlogModel->getRandomBlog($blog->id);

		$this->load->view('layouts/header', $header);
		$this->load->view('blog/view', $data);
		$this->load->view('layouts/footer', $footer);
	}
}
