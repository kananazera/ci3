<?php

class PropertyValueController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('PropertyModel');
		$this->load->model('PropertyValueModel');
		$this->load->model('ProductModel');
		$this->lang->load('control_panel', $this->session->userdata('lang'));

		if (!$this->session->has_userdata('authenticated')) {
			redirect(base_url('login'));
		}

		if ($this->UserModel->show($this->session->userdata('auth_user')->id)->is_admin != 1) {
			redirect(base_url('403'));
		}
	}

	public function index($product_id)
	{
		$data['product'] = $this->ProductModel->show($product_id);
		$data['properties'] = $this->PropertyModel->getProperties();
		$data['property_values'] = $this->PropertyValueModel->get($product_id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/properties/values', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function store($product_id)
	{
		$this->form_validation->set_rules('property_id', $this->lang->line('property'), 'required');
		$this->form_validation->set_rules('value', $this->lang->line('value'), 'required');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['property_id'] = $this->input->post('property_id');
			$data['product_id'] = $product_id;
			$data['value'] = $this->input->post('value');

			$insert = $this->PropertyValueModel->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', $this->lang->line('create_property_value_success'));
				redirect(base_url('admin/products/properties/values/' . $product_id));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_property_value_error'));
				redirect(base_url('admin/products/properties/values/' . $product_id));
			}
		}
	}

	public function delete($id, $product_id)
	{
		$delete = $this->PropertyValueModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('property_value_delete_success'));
			redirect(base_url('admin/products/properties/values/' . $product_id));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('property_value_delete_error'));
			redirect(base_url('admin/products/properties/values/' . $product_id));
		}
	}
}
