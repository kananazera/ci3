<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ContactController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ContactMessageModel');
		$this->load->library('email');
		$this->load->helper('email_helper');
	}

	public function index()
	{
		$header['title'] = $this->lang->line('contact');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('pages/contact');
		$this->load->view('layouts/footer');
	}

	public function send()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$mobile_number = $this->input->post('mobile_number');
		$message = $this->input->post('message');

		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile_number', $this->lang->line('mobile_number'), 'trim|required');
		$this->form_validation->set_rules('message', $this->lang->line('message'), 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$token = md5($email . time());

			$data['name'] = $name;
			$data['email'] = $email;
			$data['mobile_number'] = $mobile_number;
			$data['message'] = $message;
			$data['ip'] = $ip;
			$data['user_agent'] = $user_agent;

			$html = '
				<html>
					<head>
						<style>
						a {
							text-decoration: none;
						}
						div {
							text-align: center;
							margin-bottom: 25px;
						}
						p {
							text-align: left;
							margin-bottom: 25px;
						}
						</style>
					</head>
					<body>
						<div>
							<img src="' . base_url('assets/img/logo-email.png') . '" alt="">
						</div>
						
						<p><strong>' . $this->lang->line('contact') . '</strong></p>
						<p>' . $this->lang->line('name') . ': <strong>'.$data['name'].'</strong></p>
						<p>' . $this->lang->line('email') . ': <strong>'.$data['email'].'</strong></p>
						<p>' . $this->lang->line('mobile_number') . ': <strong>'.$data['mobile_number'].'</strong></p>
						<p>IP: <strong>'.$ip.'</strong></p>
						<p>User agent: <strong>'.$user_agent.'</strong></p>
						<p>' . $this->lang->line('message') . ': <strong>'.$data['message'].'</strong></p>
						
						<hr>
						<div>
							© <a href="' . base_url() . '">' . $this->config->item('app_name') . '</a> ' . date('Y') . '
						</div>
					</body>
				</html>';

			$email_helper = new \helpers\Email_helper;
			$config = $email_helper->config();

			$this->email->initialize($config);
			$this->email->from($this->config->item('admin_email'), $this->config->item('app_name'));
			$this->email->to($this->config->item('admin_email'));
			$this->email->subject($this->lang->line('contact'));
			$this->email->message($html);

			$insert = $this->ContactMessageModel->insert($data);

			if ($this->email->send() || $insert) {
				$this->session->set_flashdata('success', $this->lang->line('contact_success'));
				redirect(base_url('contact'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('send_email_error'));
				redirect(base_url('contact'));
			}
		}
	}
}
