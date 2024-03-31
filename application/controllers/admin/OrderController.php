<?php

class OrderController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('OrderStatusModel');
		$this->load->model('OrderModel');
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

		$config['base_url'] = base_url('admin/orders');
		if ($search) {
			$config['total_rows'] = $this->OrderModel->count($search);
		} else {
			$config['total_rows'] = $this->OrderModel->count();
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
			$data['orders'] = $this->OrderModel->search($search, $config['per_page'], $offset);
		} else {
			$data['orders'] = $this->OrderModel->get($config['per_page'], $offset);
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/orders/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['order'] = $this->OrderModel->show($id);
		$data['order_statuses'] = $this->OrderStatusModel->get();

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/orders/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function view($id)
	{
		$data['order'] = $this->OrderModel->show($id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/orders/view', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function update($id)
	{
		$this->form_validation->set_rules('status_id', $this->lang->line('order_status'), 'required');

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['status_id'] = $this->input->post('status_id');
			$data['admin_note'] = $this->input->post('admin_note');

			$update = $this->OrderModel->update($id, $data);

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_order_status_success'));
				redirect(base_url('admin/orders'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_order_status_error'));
				redirect(base_url('admin/orders'));
			}
		}
	}
}
