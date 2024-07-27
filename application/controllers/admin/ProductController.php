<?php

class ProductController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('CategoryModel');
		$this->load->model('ProductModel');
		$this->load->model('ProductImageModel');
		$this->load->model('CurrencyModel');
		$this->load->model('PropertyValueModel');
		$this->load->model('CommentModel');
		$this->load->helper('slug');
		$this->load->helper('product');
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

		$config['base_url'] = base_url('admin/products');
		if ($search) {
			$config['total_rows'] = $this->ProductModel->count($search);
		} else {
			$config['total_rows'] = $this->ProductModel->count();
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
			$data['products'] = $this->ProductModel->search($search, $config['per_page'], $offset);
		} else {
			$data['products'] = $this->ProductModel->get($config['per_page'], $offset);
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function images($product_id)
	{
		$data['product'] = $this->ProductModel->show($product_id);
		$data['images'] = $this->ProductImageModel->get($product_id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/images', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$data['categories'] = $this->CategoryModel->getAllCategories();
		$data['currencies'] = $this->CurrencyModel->getCurrencies();

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/create', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['product'] = $this->ProductModel->show($id);
		$data['categories'] = $this->CategoryModel->getAllCategories();
		$data['currencies'] = $this->CurrencyModel->getCurrencies();

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function uploadImages($product_id)
	{
		for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
			$_FILES['file']['name'] = $_FILES['images']['name'][$i];
			$_FILES['file']['type'] = $_FILES['images']['type'][$i];
			$_FILES['file']['size'] = $_FILES['images']['size'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['images']['error'][$i];
			$this->uploadImage($product_id, 'file');
		}
		redirect(base_url('admin/products/images/' . $product_id));
	}

	public function uploadImage($product_id, $file)
	{
		$config['upload_path'] = 'uploads/product/image/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 100000;
		$config['encrypt_name'] = true;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload($file)) {
			$upload_data = $this->upload->data();
			$data['product_id'] = $product_id;
			$data['image'] = $upload_data['file_name'];
			$this->ProductImageModel->insert($data);
			$this->session->set_flashdata('success', $this->lang->line('product_images_upload_success'));
		} else {
			$this->session->set_flashdata('error', $this->upload->display_errors());
		}
	}

	public function store()
	{
		$this->form_validation->set_rules('category_id', $this->lang->line('category'), 'required');
		$this->form_validation->set_rules('title', $this->lang->line('title'), 'required');
		$this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
		$this->form_validation->set_rules('quantity', $this->lang->line('quantity'), 'required');
		$this->form_validation->set_rules('price', $this->lang->line('price'), 'required');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['category_id'] = $this->input->post('category_id');
			$data['slug'] = ($this->input->post('slug')) ? $data['slug'] = $this->input->post('slug') : generateSlug($this->input->post('title'));
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			$data['quantity'] = $this->input->post('quantity');
			$data['price'] = $this->input->post('price');
			$data['discount_rate'] = $this->input->post('discount_rate');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;

			$insert = $this->ProductModel->insert($data);
			$product_id = $this->db->insert_id();

			if ($insert) {
				$this->session->set_flashdata('success', $this->lang->line('create_product_success'));
				redirect(base_url('admin/products/images/' . $product_id));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_product_error'));
				redirect(base_url('admin/products'));
			}
		}
	}

	public function update($id)
	{
		$product = $this->ProductModel->show($id);

		$this->form_validation->set_rules('category_id', $this->lang->line('category'), 'required');
		$this->form_validation->set_rules('title', $this->lang->line('title'), 'required');
		$this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
		$this->form_validation->set_rules('quantity', $this->lang->line('quantity'), 'required');
		$this->form_validation->set_rules('price', $this->lang->line('price'), 'required');

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['category_id'] = $this->input->post('category_id');
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			$data['quantity'] = $this->input->post('quantity');
			$data['price'] = $this->input->post('price');
			$data['discount_rate'] = $this->input->post('discount_rate');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;

			if (!$this->input->post('slug')) {
				$data['slug'] = generateSlug($this->input->post('title'));
			} else if ($product->slug != $this->input->post('slug')) {
				$data['slug'] = $this->input->post('slug');
			} else if ($product->title != $this->input->post('title')) {
				$data['slug'] = generateSlug($this->input->post('title'));
			} else {
				$data['slug'] = $this->input->post('slug');
			}

			$update = $this->ProductModel->update($id, $data);

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_product_success'));
				redirect(base_url('admin/products'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_product_error'));
				redirect(base_url('admin/products'));
			}
		}
	}

	public function delete($id)
	{
		$images = $this->ProductImageModel->get($id);
		foreach ($images as $image) {
			unlink('uploads/product/image/' . $image->image);
			$this->ProductImageModel->delete($image->id);
		}

		$this->CommentModel->deleteByProductId($id);

		$delete = $this->ProductModel->delete($id);

		if ($delete) {
			$this->PropertyValueModel->deleteByProductId($id);
			$this->session->set_flashdata('success', $this->lang->line('product_delete_success'));
			redirect(base_url('admin/products'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('product_delete_error'));
			redirect(base_url('admin/products'));
		}
	}

	public function deleteImage($id, $product_id)
	{
		$product_image = $this->ProductImageModel->show($id);

		$unlink = unlink('uploads/product/image/' . $product_image->image);

		if ($unlink) {
			$this->ProductImageModel->delete($id);
			$this->session->set_flashdata('success', $this->lang->line('product_image_delete_success'));
			redirect(base_url('admin/products/images/' . $product_id));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('product_image_delete_error'));
			redirect(base_url('admin/products/images/' . $product_id));
		}
	}

	public function mainImage($id, $product_id)
	{
		$this->ProductImageModel->updateAllImagesMain();

		$data['main'] = true;
		$update = $this->ProductImageModel->update($id, $data);

		if ($update) {
			$this->session->set_flashdata('success', $this->lang->line('product_image_main_success'));
			redirect(base_url('admin/products/images/' . $product_id));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('product_image_main_error'));
			redirect(base_url('admin/products/images/' . $product_id));
		}
	}
}
