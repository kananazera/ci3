<?php

class UserController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('CommentModel');
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

		$config['base_url'] = base_url('admin/users');
		if ($search) {
			$config['total_rows'] = $this->UserModel->count($search);
		} else {
			$config['total_rows'] = $this->UserModel->count();
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
			$data['users'] = $this->UserModel->search($search, $config['per_page'], $offset);
		} else {
			$data['users'] = $this->UserModel->get($config['per_page'], $offset);
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/users/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/users/create');
		$this->load->view('admin/layouts/footer');
	}

	public function edit($id)
	{
		$data['user'] = $this->UserModel->show($id);

		if ($data['user']->is_admin == 1) {
			$this->session->set_flashdata('error', $this->lang->line('user_can_not_edit'));
			redirect(base_url('admin/users'));
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/users/edit', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|alpha');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'min_length[6]');
		$this->form_validation->set_rules('mobile_number', $this->lang->line('mobile_number'), 'min_length[9]');

		if ($this->form_validation->run() == false) {
			$this->create();
		} else {
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['password'] = md5($this->input->post('password'));
			$data['mobile_number'] = $this->input->post('mobile_number');
			$data['birthday'] = $this->input->post('birthday');
			$data['gender'] = $this->input->post('gender');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;
			$data['email_verified'] = ($this->input->post('email_verified') == 'on') ? date('Y-m-d H:i:s') : null;

			$insert = $this->UserModel->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', $this->lang->line('create_user_success'));
				redirect(base_url('admin/users'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('create_user_error'));
				redirect(base_url('admin/users'));
			}
		}
	}

	public function update($id)
	{
		$user = $this->UserModel->show($id);
		if ($user->is_admin == 1) {
			$this->session->set_flashdata('error', $this->lang->line('user_can_not_edit'));
			redirect(base_url('admin/users'));
		}

		$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|alpha');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'min_length[6]');
		$this->form_validation->set_rules('mobile_number', $this->lang->line('mobile_number'), 'min_length[9]');

		if ($user->email != $this->input->post('email')) {
			$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|is_unique[users.email]');
		}

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['password'] = md5($this->input->post('password'));
			$data['mobile_number'] = $this->input->post('mobile_number');
			$data['birthday'] = $this->input->post('birthday');
			$data['gender'] = $this->input->post('gender');
			$data['is_active'] = ($this->input->post('is_active') == 'on') ? 1 : 0;
			$data['email_verified'] = ($this->input->post('email_verified') == 'on') ? date('Y-m-d H:i:s') : null;

			$update = $this->UserModel->update($id, $data);

			if ($update) {
				$this->session->set_flashdata('success', $this->lang->line('edit_user_success'));
				redirect(base_url('admin/users'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('edit_user_error'));
				redirect(base_url('admin/users'));
			}
		}
	}

	public function delete($id)
	{
		$user = $this->UserModel->show($id);
		if ($user->is_admin == 1) {
			$this->session->set_flashdata('error', $this->lang->line('user_can_not_delete'));
			redirect(base_url('admin/users'));
		}

		unlink('uploads/user/photo/' . $user->photo);

		$this->CommentModel->deleteByUserId($id);

		$delete = $this->UserModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('user_delete_success'));
			redirect(base_url('admin/users'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('user_delete_error'));
			redirect(base_url('admin/users'));
		}
	}

	public function deletePhoto($id)
	{
		$user = $this->UserModel->show($id);

		$unlink = unlink('uploads/user/photo/' . $user->photo);

		if ($unlink) {
			$data['photo'] = null;
			$this->UserModel->update($id, $data);
			$this->session->set_flashdata('success', $this->lang->line('user_photo_delete_success'));
			redirect(base_url('admin/users/edit/' . $id));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('user_photo_delete_error'));
			redirect(base_url('admin/users/edit/' . $id));
		}
	}

	public function uploadPhoto($id)
	{
		$config['upload_path'] = 'uploads/user/photo/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 100000;
		$config['encrypt_name'] = true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('photo')) {
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect(base_url('admin/users/edit/' . $id));
		} else {
			$upload_data = $this->upload->data();

			$data['photo'] = $upload_data['file_name'];

			$this->UserModel->update($id, $data);

			$user = $this->UserModel->show($id);

			if ($user->photo) {
				unlink('uploads/user/photo/' . $user->photo);
			}

			$this->session->set_flashdata('success', $this->lang->line('photo_upload_success'));
			redirect(base_url('admin/users/edit/' . $id));
		}
	}
}
