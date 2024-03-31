<?php

class CityController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('CountryModel');
		$this->load->model('CityModel');
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

		$config['base_url'] = base_url('admin/cities');
		if ($search) {
			$config['total_rows'] = $this->CityModel->count($search);
		} else {
			$config['total_rows'] = $this->CityModel->count();
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
			$data['cities'] = $this->CityModel->search($search, $config['per_page'], $offset);
		} else {
			$data['cities'] = $this->CityModel->get($config['per_page'], $offset);
		}

		$data['countries'] = $this->CountryModel->getCountries();

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/locations/cities/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$data['countries'] = $this->CountryModel->getCountries();

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/locations/cities/create', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['city'] = $this->CityModel->show($id);
		$data['countries'] = $this->CountryModel->getCountries();

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/locations/cities/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('country_id', $this->lang->line('country'), 'required');
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'required|is_unique[cities.name]');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['country_id'] = $this->input->post('country_id');
			$data['name'] = $this->input->post('name');

			$insert = $this->CityModel->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', $this->lang->line('create_city_success'));
				redirect(base_url('admin/cities'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_city_error'));
				redirect(base_url('admin/cities'));
			}
		}
	}

	public function update($id)
	{
		$city = $this->CityModel->show($id);

		if ($city->name != $this->input->post('name')) {
			$this->form_validation->set_rules('name', $this->lang->line('name'), 'required|is_unique[cities.name]');
		}

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['country_id'] = $this->input->post('country_id');
			$data['name'] = $this->input->post('name');

			$update = $this->CityModel->update($id, $data);

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_city_success'));
				redirect(base_url('admin/cities'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_city_error'));
				redirect(base_url('admin/cities'));
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->CityModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('city_delete_success'));
			redirect(base_url('admin/cities'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('city_delete_error'));
			redirect(base_url('admin/cities'));
		}
	}
}
