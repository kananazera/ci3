<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasswordController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('PasswordResetTokenModel');

		if ($this->session->has_userdata('authenticated')) {
			redirect(base_url());
		}
	}

	public function index()
	{
		$header['title'] = $this->lang->line('forgot_password');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('auth/password/send');
		$this->load->view('layouts/footer');
	}

	public function reset()
	{
		$header['title'] = $this->lang->line('forgot_password');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('auth/password/reset');
		$this->load->view('layouts/footer');
	}

	public function send()
	{
		$email = $this->input->post('email');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			if ($this->UserModel->checkEmail($email) == false) {
				$this->session->set_flashdata('error', $this->lang->line('forgot_password_error'));
				redirect(base_url('forgot-password'));
			} else {
				$token = md5($email . time());

				$data['email'] = $email;
				$data['token'] = $token;

				if ($this->PasswordResetTokenModel->checkToken($email) == false) {
					$this->PasswordResetTokenModel->insert($data);
					$link = base_url('password/reset/' . $token);


//					$config['protocol'] = 'smtp';
//					$config['smtp_host'] = 'smtp.gmail.com';
//					$config['smtp_user'] = 'kananazera@gmail.com';
//					$config['smtp_pass'] = 'ztvjgzihncklfyly';
//					$config['smtp_port'] = 465;
//					$config['smtp_crypto'] = 'ssl';
//					$config['charset'] = 'utf-8';
//					$config['mailtype'] = 'html';

					$config['protocol'] = 'mail';
					//$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = true;

					$this->email->initialize($config);

					$this->load->library('email');
					//$this->email->initialize($config);

					$this->email->from('kananazera@gmail.com', 'kanan');
					$this->email->to('kananazera@gmail.com');
					$this->email->subject('Here is your info ');
					$this->email->message('Hi Here is the info you requested.');

					if ($this->email->send()) {
						echo 'ok';
					} else {
						echo 'error';
					}

					//$this->session->set_flashdata('success', $this->lang->line('forgot_password_success'));
					//redirect(base_url('forgot-password'));
				} else {
					$this->session->set_flashdata('error', $this->lang->line('forgot_password_exists'));
					redirect(base_url('forgot-password'));
				}
			}
		}
	}
}
