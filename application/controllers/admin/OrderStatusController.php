<?php

class OrderStatusController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('OrderStatusModel');
		$this->load->model('OrderModel');
		$this->lang->load('control_panel', $this->session->userdata('lang'));

		if (!$this->session->has_userdata('authenticated')) {
			redirect(base_url('login'));
		}

		if ($this->UserModel->show($this->session->userdata('auth_user')->id)->is_admin != 1) {
			redirect(base_url('403'));
		}
	}

	public function index()
	{
		$data['order_statuses'] = $this->OrderStatusModel->get();

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/orders/statuses/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/orders/statuses/create');
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['order_status'] = $this->OrderStatusModel->show($id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/orders/statuses/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'required|is_unique[order_statuses.name]');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['name'] = $this->input->post('name');

			$insert = $this->OrderStatusModel->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', $this->lang->line('create_order_status_success'));
				redirect(base_url('admin/orders/statuses'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_order_status_error'));
				redirect(base_url('admin/orders/statuses'));
			}
		}
	}

	public function update($id)
	{
		$order_status = $this->OrderStatusModel->show($id);

		if ($order_status->name != $this->input->post('name')) {
			$this->form_validation->set_rules('name', $this->lang->line('name'), 'required|is_unique[order_statuses.name]');
		}

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['name'] = $this->input->post('name');

			$update = $this->OrderStatusModel->update($id, $data);

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_order_status_success'));
				redirect(base_url('admin/orders/statuses'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_order_status_error'));
				redirect(base_url('admin/orders/statuses'));
			}
		}
	}

	public function delete($id)
	{
		$order = $this->OrderModel->searchByStatusId($id);

		if ($order->status_id == $id) {
			$this->session->set_flashdata('error', $this->lang->line('order_status_can_not_delete_reason_order'));
			redirect(base_url('admin/orders/statuses'));
		}
		
		$delete = $this->OrderStatusModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('order_status_delete_success'));
			redirect(base_url('admin/orders/statuses'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('order_status_delete_error'));
			redirect(base_url('admin/orders/statuses'));
		}
	}
}
