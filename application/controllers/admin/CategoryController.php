<?php

class CategoryController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('CategoryModel');
		$this->load->model('ProductModel');
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

		$config['base_url'] = base_url('admin/categories');
		if ($search) {
			$config['total_rows'] = $this->CategoryModel->count($search);
		} else {
			$config['total_rows'] = $this->CategoryModel->count();
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
			$data['categories'] = $this->CategoryModel->search($search, $config['per_page'], $offset);
		} else {
			$data['categories'] = $this->CategoryModel->get($config['per_page'], $offset);
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/categories/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$data['categories'] = $this->CategoryModel->getAllCategories();

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/categories/create', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['category'] = $this->CategoryModel->show($id);
		$data['categories'] = $this->CategoryModel->getAllCategories();

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/categories/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'required|is_unique[categories.name]');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['parent_id'] = $this->input->post('parent_id');
			$data['slug'] = ($this->input->post('slug')) ? $data['slug'] = $this->input->post('slug') : generateSlug($this->input->post('name'));
			$data['name'] = $this->input->post('name');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;

			$insert = $this->CategoryModel->insert($data);

			if ($insert) {
				if ($_FILES['image']['name']) {
					$this->uploadImage($this->db->insert_id());
				}
				$this->session->set_flashdata('success', $this->lang->line('create_category_success'));
				redirect(base_url('admin/categories'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_category_error'));
				redirect(base_url('admin/categories'));
			}
		}
	}

	public function update($id)
	{
		$category = $this->CategoryModel->show($id);

		if ($this->input->post('parent_id') == $id) {
			$this->session->set_flashdata('error', $this->lang->line('category_can_not_set_parent'));
			redirect(base_url('admin/categories'));
		}

		if ($category->name != $this->input->post('name')) {
			$this->form_validation->set_rules('name', $this->lang->line('name'), 'required|is_unique[categories.name]');
		} else {
			$this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
		}

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['parent_id'] = $this->input->post('parent_id');
			$data['name'] = $this->input->post('name');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;

			if(!$this->input->post('slug')) {
				$data['slug'] = generateSlug($this->input->post('name'));
			} else if ($category->slug != $this->input->post('slug')) {
				$data['slug'] = $this->input->post('slug');
			} else if ($category->name != $this->input->post('name')) {
				$data['slug'] = generateSlug($this->input->post('name'));
			} else {
				$data['slug'] = $this->input->post('slug');
			}

			$update = $this->CategoryModel->update($id, $data);

			if ($_FILES['image']['name']) {
				$category = $this->CategoryModel->show($id);
				if ($category->image) {
					unlink('uploads/category/image/' . $category->image);
					$data['image'] = null;
					$this->CategoryModel->update($id, $data);
				}
				$this->uploadImage($id);
			}

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_category_success'));
				redirect(base_url('admin/categories'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_category_error'));
				redirect(base_url('admin/categories'));
			}
		}
	}

	public function delete($id)
	{
		$category = $this->CategoryModel->searchByParentId($id);
		$product = $this->ProductModel->searchByCategoryId($id);
		$category_image = $this->CategoryModel->show($id)->image;

		if ($category->parent_id == $id) {
			$this->session->set_flashdata('error', $this->lang->line('category_can_not_delete_reason_parent'));
			redirect(base_url('admin/categories'));
		}

		if ($product->category_id == $id) {
			$this->session->set_flashdata('error', $this->lang->line('category_can_not_delete_reason_product'));
			redirect(base_url('admin/categories'));
		}

		if ($category_image) {
			unlink('uploads/category/image/' . $category_image);
		}

		$delete = $this->CategoryModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('category_delete_success'));
			redirect(base_url('admin/categories'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('category_delete_error'));
			redirect(base_url('admin/categories'));
		}
	}

	public function uploadImage($id)
	{
		$config['upload_path'] = 'uploads/category/image/';
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
			$this->CategoryModel->update($id, $data);
		}
	}

	public function deleteImage($id)
	{
		$category = $this->CategoryModel->show($id);
		$unlink = unlink('uploads/category/image/' . $category->image);
		if ($unlink) {
			$data['image'] = null;
			$this->CategoryModel->update($id, $data);
		}
		$this->session->set_flashdata('success', $this->lang->line('category_image_delete_success'));
		redirect(base_url('admin/categories/edit/' . $id));
	}
}
