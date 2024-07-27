<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasswordController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('PasswordResetTokenModel');
		$this->load->helper('email_helper');

		if ($this->session->has_userdata('authenticated')) {
			redirect(base_url());
		}
	}

	public function index()
	{
		$header['title'] = $this->lang->line('forgot_password');

		$this->load->view('layouts/header', $header);
		$this->load->view('auth/password/send');
		$this->load->view('layouts/footer');
	}

	public function reset($token)
	{
		$data['token'] = $this->PasswordResetTokenModel->get($token);

		$header['title'] = $this->lang->line('reset_password');

		$this->load->view('layouts/header', $header);
		$this->load->view('auth/password/reset', $data);
		$this->load->view('layouts/footer');
	}

	public function change()
	{
		$token = $this->input->post('token');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('password', $this->lang->line('password'), 'min_length[6]');
		$this->form_validation->set_rules('password_confirmation', $this->lang->line('password_confirmation'), 'matches[password]');

		if ($this->form_validation->run() == false) {
			$this->reset($token);
		} else {

			if (!$this->PasswordResetTokenModel->get($token)) {
				$this->session->set_flashdata('error', $this->lang->line('reset_password_error'));
				redirect(base_url('login'));
			}

			$data['password'] = md5($password);

			$user_id = $this->UserModel->check($email)->id;
			$token_id = $this->PasswordResetTokenModel->get($token)->id;

			$result = $this->UserModel->update($user_id, $data);

			if ($result > 0) {
				$this->PasswordResetTokenModel->delete($token_id);
				$this->session->set_flashdata('success', $this->lang->line('reset_password_success'));
				redirect(base_url('login'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('forgot_password_error'));
				redirect(base_url('login'));
			}
		}
	}

	public function send()
	{
		$email = $this->input->post('email');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			if ($this->UserModel->check($email) == false) {
				$this->session->set_flashdata('error', $this->lang->line('forgot_password_error'));
				redirect(base_url('forgot-password'));
			} else {
				$token = md5($email . time());

				$data['email'] = $email;
				$data['token'] = $token;
				$data['date'] = date('Y-m-d');

				if ($this->PasswordResetTokenModel->check($email) == false) {

					$this->PasswordResetTokenModel->insert($data);
					$token_id = $this->db->insert_id();

					$link = base_url('password/reset/' . $token);

					$data_email['link'] = $link;
					$message = $this->load->view('email/password', $data_email, true);

					$send = sendEmail($email, $this->lang->line('reset_password'), $message);

					if ($send) {
						$this->session->set_flashdata('success', $this->lang->line('forgot_password_success'));
						redirect(base_url('forgot-password'));
					} else {
						$this->PasswordResetTokenModel->delete($token_id);
						$this->session->set_flashdata('error', $this->lang->line('send_email_error'));
						redirect(base_url('forgot-password'));
					}

				} else {
					$this->session->set_flashdata('error', $this->lang->line('forgot_password_exists'));
					redirect(base_url('forgot-password'));
				}
			}
		}
	}
}
