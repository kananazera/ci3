<?php

class CurrencyController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('CurrencyModel');
		$this->load->model('ProductModel');
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

		$config['base_url'] = base_url('admin/products/currencies');
		if ($search) {
			$config['total_rows'] = $this->CurrencyModel->count($search);
		} else {
			$config['total_rows'] = $this->CurrencyModel->count();
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
			$data['currencies'] = $this->CurrencyModel->search($search, $config['per_page'], $offset);
		} else {
			$data['currencies'] = $this->CurrencyModel->get($config['per_page'], $offset);
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/currencies/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/currencies/create');
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['currency'] = $this->CurrencyModel->show($id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/products/currencies/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
		$this->form_validation->set_rules('code', $this->lang->line('code'), 'required');
		$this->form_validation->set_rules('symbol', $this->lang->line('symbol'), 'required');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['name'] = $this->input->post('name');
			$data['code'] = $this->input->post('code');
			$data['symbol'] = $this->input->post('symbol');

			$insert = $this->CurrencyModel->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', $this->lang->line('create_currency_success'));
				redirect(base_url('admin/products/currencies'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_currency_error'));
				redirect(base_url('admin/products/currencies'));
			}
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
		$this->form_validation->set_rules('code', $this->lang->line('code'), 'required');
		$this->form_validation->set_rules('symbol', $this->lang->line('symbol'), 'required');

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['name'] = $this->input->post('name');
			$data['code'] = $this->input->post('code');
			$data['symbol'] = $this->input->post('symbol');

			$update = $this->CurrencyModel->update($id, $data);

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_currency_success'));
				redirect(base_url('admin/products/currencies'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_currency_error'));
				redirect(base_url('admin/products/currencies'));
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->CurrencyModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('currency_delete_success'));
			redirect(base_url('admin/products/currencies'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('currency_delete_error'));
			redirect(base_url('admin/products/currencies'));
		}
	}
}
