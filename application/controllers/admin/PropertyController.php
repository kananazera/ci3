<?php

class PropertyController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('PropertyModel');
		$this->load->model('PropertyValueModel');
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

		$config['base_url'] = base_url('admin/products/properties');
		if ($search) {
			$config['total_rows'] = $this->PropertyModel->count($search);
		} else {
			$config['total_rows'] = $this->PropertyModel->count();
		}
		$config['per_page'] = 10;
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
			$data['properties'] = $this->PropertyModel->search($search, $config['per_page'], $offset);
		} else {
			$data['properties'] = $this->PropertyModel->get($config['per_page'], $offset);
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/properties/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/properties/create');
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['property'] = $this->PropertyModel->show($id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/properties/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'required|is_unique[product_properties.name]');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['name'] = $this->input->post('name');

			$insert = $this->PropertyModel->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', $this->lang->line('create_property_success'));
				redirect(base_url('admin/products/properties'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_property_error'));
				redirect(base_url('admin/products/properties'));
			}
		}
	}

	public function update($id)
	{
		$property = $this->PropertyModel->show($id);

		if ($property->name != $this->input->post('name')) {
			$this->form_validation->set_rules('name', $this->lang->line('name'), 'required|is_unique[product_properties.name]');
		}

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['name'] = $this->input->post('name');

			$update = $this->PropertyModel->update($id, $data);

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_property_success'));
				redirect(base_url('admin/products/properties'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_property_error'));
				redirect(base_url('admin/products/properties'));
			}
		}
	}

	public function delete($id)
	{
		$property_value = $this->PropertyValueModel->searchByPropertyId($id);

		if($property_value->property_id == $id) {
			$this->session->set_flashdata('error', $this->lang->line('property_can_not_delete_reason_property_value'));
			redirect(base_url('admin/products/properties'));
		}

		$delete = $this->PropertyModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('property_delete_success'));
			redirect(base_url('admin/products/properties'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('property_delete_error'));
			redirect(base_url('admin/products/properties'));
		}
	}
}
