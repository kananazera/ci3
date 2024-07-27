<?php

class CommentController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('CommentModel');
		$this->load->model('ProductModel');
		$this->load->helper('date');
		$this->lang->load('control_panel', $this->session->userdata('lang'));

		if (!$this->session->has_userdata('authenticated')) {
			redirect(base_url('login'));
		}

		if ($this->UserModel->show($this->session->userdata('auth_user')->id)->is_admin != 1) {
			redirect(base_url('403'));
		}
	}

	public function index($offset = 0)
	{
		$search = $this->input->post('search');

		$this->load->library('pagination');

		$config['base_url'] = base_url('admin/products/comments');
		if ($search) {
			$config['total_rows'] = $this->CommentModel->count($search);
		} else {
			$config['total_rows'] = $this->CommentModel->count();
		}
		$config['per_page'] = 25;
		$config['uri_segment'] = 4;

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
			$data['comments'] = $this->CommentModel->search($search, $config['per_page'], $offset);
		} else {
			$data['comments'] = $this->CommentModel->get($config['per_page'], $offset);
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/comments/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function approve($id)
	{
		$data['is_active'] = true;
		$update = $this->CommentModel->update($id, $data);

		if ($update) {
			$this->session->set_flashdata('success', $this->lang->line('approve_comment_success'));
			redirect(base_url('admin/products/comments'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('approve_comment_error'));
			redirect(base_url('admin/products/comments'));
		}
	}

	public function view($id)
	{
		$data['comment'] = $this->CommentModel->show($id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/comments/view', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function delete($id)
	{
		$delete = $this->CommentModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('comment_delete_success'));
			redirect(base_url('admin/products/comments'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('comment_delete_error'));
			redirect(base_url('admin/products/comments'));
		}
	}
}
