<?php

class PageController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->helper('slug');
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

		$config['base_url'] = base_url('admin/pages');
		if ($search) {
			$config['total_rows'] = $this->PageModel->count($search);
		} else {
			$config['total_rows'] = $this->PageModel->count();
		}
		$config['per_page'] = 10;
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

		if ($search) {
			$data['pages'] = $this->PageModel->search($search, $config['per_page'], $offset);
		} else {
			$data['pages'] = $this->PageModel->get($config['per_page'], $offset);
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/pages/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/pages/create');
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['page'] = $this->PageModel->show($id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/pages/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('title', $this->lang->line('title'), 'required');
		$this->form_validation->set_rules('content', $this->lang->line('content'), 'required');
		$this->form_validation->set_rules('lang', $this->lang->line('lang'), 'required');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['lang'] = $this->input->post('lang');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;
			$data['slug'] = ($this->input->post('slug')) ? $data['slug'] = $this->input->post('slug') : generateSlug($this->input->post('title'));

			$insert = $this->PageModel->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', $this->lang->line('create_page_success'));
				redirect(base_url('admin/pages'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_page_error'));
				redirect(base_url('admin/pages'));
			}
		}
	}

	public function update($id)
	{
		$page = $this->PageModel->show($id);

		$this->form_validation->set_rules('title', $this->lang->line('title'), 'required');
		$this->form_validation->set_rules('content', $this->lang->line('content'), 'required');
		$this->form_validation->set_rules('lang', $this->lang->line('lang'), 'required');

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['lang'] = $this->input->post('lang');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;

			if(!$this->input->post('slug')) {
				$data['slug'] = generateSlug($this->input->post('title'));
			} else if ($page->slug != $this->input->post('slug')) {
				$data['slug'] = $this->input->post('slug');
			} else if ($page->title != $this->input->post('title')) {
				$data['slug'] = generateSlug($this->input->post('title'));
			} else {
				$data['slug'] = $this->input->post('slug');
			}

			$update = $this->PageModel->update($id, $data);

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_page_success'));
				redirect(base_url('admin/pages'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_page_error'));
				redirect(base_url('admin/pages'));
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->PageModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('page_delete_success'));
			redirect(base_url('admin/pages'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('page_delete_error'));
			redirect(base_url('admin/pages'));
		}
	}
}
