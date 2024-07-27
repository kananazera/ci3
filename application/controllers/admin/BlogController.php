<?php

class BlogController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('BlogModel');
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

		$config['base_url'] = base_url('admin/blog');
		if ($search) {
			$config['total_rows'] = $this->BlogModel->count($search);
		} else {
			$config['total_rows'] = $this->BlogModel->count();
		}
		$config['per_page'] = 25;
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
			$data['blog'] = $this->BlogModel->search($search, $config['per_page'], $offset);
		} else {
			$data['blog'] = $this->BlogModel->get($config['per_page'], $offset);
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/blog/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/blog/create');
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['blog'] = $this->BlogModel->show($id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/blog/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('title', $this->lang->line('title'), 'required|is_unique[blog.title]');
		$this->form_validation->set_rules('content', $this->lang->line('content'), 'required');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['slug'] = ($this->input->post('slug')) ? $data['slug'] = $this->input->post('slug') : generateSlug($this->input->post('title'));
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;

			$insert = $this->BlogModel->insert($data);

			if ($insert) {
				if ($_FILES['image']['name']) {
					$this->uploadImage($this->db->insert_id());
				}
				$this->session->set_flashdata('success', $this->lang->line('create_blog_success'));
				redirect(base_url('admin/blog'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_blog_error'));
				redirect(base_url('admin/blog'));
			}
		}
	}

	public function update($id)
	{
		$blog = $this->BlogModel->show($id);

		if ($blog->title != $this->input->post('title')) {
			$this->form_validation->set_rules('title', $this->lang->line('title'), 'required|is_unique[blog.title]');
		} else {
			$this->form_validation->set_rules('title', $this->lang->line('title'), 'required');
		}

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;

			if (!$this->input->post('slug')) {
				$data['slug'] = generateSlug($this->input->post('title'));
			} else if ($blog->slug != $this->input->post('slug')) {
				$data['slug'] = $this->input->post('slug');
			} else if ($blog->title != $this->input->post('title')) {
				$data['slug'] = generateSlug($this->input->post('title'));
			} else {
				$data['slug'] = $this->input->post('slug');
			}

			$update = $this->BlogModel->update($id, $data);

			if ($_FILES['image']['name']) {
				$blog = $this->BlogModel->show($id);
				if ($blog->image) {
					unlink('uploads/blog/image/' . $blog->image);
					$data['image'] = null;
					$this->BlogModel->update($id, $data);
				}
				$this->uploadImage($id);
			}

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_blog_success'));
				redirect(base_url('admin/blog'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_blog_error'));
				redirect(base_url('admin/blog'));
			}
		}
	}

	public function delete($id)
	{
		$blog_image = $this->BlogModel->show($id)->image;

		if ($blog_image) {
			unlink('uploads/blog/image/' . $blog_image);
		}

		$delete = $this->BlogModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('blog_delete_success'));
			redirect(base_url('admin/blog'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('blog_delete_error'));
			redirect(base_url('admin/blog'));
		}
	}

	public function uploadImage($id)
	{
		$config['upload_path'] = 'uploads/blog/image/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 100000;
		$config['encrypt_name'] = true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			$this->session->set_flashdata('error', $this->upload->display_errors());
		} else {
			$this->session->set_flashdata('success', $this->lang->line('photo_upload_success'));
			$upload_data = $this->upload->data();
			$data['image'] = $upload_data['file_name'];
			$this->BlogModel->update($id, $data);
		}
	}

	public function deleteImage($id)
	{
		$blog = $this->BlogModel->show($id);
		$unlink = unlink('uploads/blog/image/' . $blog->image);
		if ($unlink) {
			$data['image'] = null;
			$this->BlogModel->update($id, $data);
		}
		$this->session->set_flashdata('success', $this->lang->line('blog_image_delete_success'));
		redirect(base_url('admin/blog/edit/' . $id));
	}
}
