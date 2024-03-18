<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');

		if (!$this->session->has_userdata('authenticated')) {
			redirect(base_url('login'));
		}

		if ($this->UserModel->getUser($this->session->userdata('auth_user')->id)->is_active == 0) {
			$this->session->set_flashdata('error', $this->lang->line('user_is_not_active'));
			redirect(base_url('logout'));
		}
	}

	public function index()
	{
		$header['title'] = $this->lang->line('profile');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('user/profile');
		$this->load->view('layouts/footer');
	}

	public function updateInformation()
	{
		$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|alpha');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|callback_email_check');
		$this->form_validation->set_rules('mobile_number', $this->lang->line('mobile_number'), 'min_length[9]');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['mobile_number'] = $this->input->post('mobile_number');
			$data['birthday'] = $this->input->post('birthday');
			$data['gender'] = $this->input->post('gender');

			$user_id = $this->session->userdata('auth_user')->id;

			$result = $this->UserModel->update($user_id, $data);

			if ($result > 0) {
				$updated_user_data = $this->UserModel->getUser($user_id);
				$this->session->set_userdata('auth_user', $updated_user_data);
				$this->session->set_flashdata('success', $this->lang->line('information_updated_success'));
				redirect(base_url('profile'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('information_updated_error'));
				redirect(base_url('profile'));
			}
		}
	}

	public function email_check($email)
	{
		if ($email == $this->session->userdata('auth_user')->email) {
			return true;
		} else {
			if ($this->UserModel->checkEmail($email) == false) {
				return true;
			} else {
				$this->form_validation->set_message('email_check', $this->lang->line('form_validation_is_unique'));
				return false;
			}
		}
	}

	public function changePassword()
	{
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'min_length[6]');
		$this->form_validation->set_rules('password_confirmation', $this->lang->line('password_confirmation'), 'matches[password]');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			if ($this->session->userdata('auth_user')->password != md5($this->input->post('current_password'))) {
				$this->session->set_flashdata('error', $this->lang->line('current_password_error'));
				redirect(base_url('profile'));
			}

			$data['password'] = md5($this->input->post('password'));

			$user_id = $this->session->userdata('auth_user')->id;

			$result = $this->UserModel->update($user_id, $data);

			if ($result > 0) {
				$updated_user_data = $this->UserModel->getUser($user_id);

				$this->session->set_userdata('auth_user', $updated_user_data);
				$this->session->set_flashdata('success', $this->lang->line('password_changed_success'));
				redirect(base_url('profile'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('password_changed_error'));
				redirect(base_url('profile'));
			}
		}
	}

	public function uploadPhoto()
	{
		$config['upload_path'] = 'uploads/user/photo/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 10000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('photo')) {
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect(base_url('profile'));
		} else {
			$upload_data = $this->upload->data();

			$data['photo'] = $upload_data['file_name'];

			$user_id = $this->session->userdata('auth_user')->id;
			$this->UserModel->update($user_id, $data);
			$updated_user_data = $this->UserModel->getUser($user_id);

			if ($this->session->userdata('auth_user')->photo) {
				unlink('uploads/user/photo/' . $this->session->userdata('auth_user')->photo);
			}

			$this->session->set_userdata('auth_user', $updated_user_data);
			$this->session->set_flashdata('success', $this->lang->line('photo_upload_success'));
			redirect(base_url('profile'));
		}
	}
}
