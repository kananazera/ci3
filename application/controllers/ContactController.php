<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ContactController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ContactMessageModel');
		$this->load->library('email');
		$this->load->helper('email');
	}

	public function index()
	{
		$header['title'] = $this->lang->line('contact');

		$this->load->view('layouts/header', $header);
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
		$this->form_validation->set_rules('message', $this->lang->line('message'), 'trim|required|min_length[10]');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$data['name'] = $name;
			$data['email'] = $email;
			$data['mobile_number'] = $mobile_number;
			$data['message'] = $message;
			$data['ip'] = $ip;
			$data['user_agent'] = $user_agent;

			$message = $this->load->view('email/contact', $data, true);

			$send = sendEmail($this->config->item('admin_email'), $this->lang->line('contact'), $message);

			$insert = $this->ContactMessageModel->insert($data);

			if ($send || $insert) {
				$this->session->set_flashdata('success', $this->lang->line('contact_success'));
				redirect(base_url('contact'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('send_email_error'));
				redirect(base_url('contact'));
			}
		}
	}
}
