<?php

class ContactMessageController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('ContactMessageModel');
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
		$this->load->library('pagination');

		$config['base_url'] = base_url('admin/contact/messages');
		$config['total_rows'] = $this->ContactMessageModel->count();
		$config['per_page'] = 25;
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

		$data['contact_messages'] = $this->ContactMessageModel->get($config['per_page'], $offset);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/contact_messages/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function view($id)
	{
		$data['is_read'] = true;
		$this->ContactMessageModel->update($id, $data);

		$data['contact_message'] = $this->ContactMessageModel->show($id);

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/contact_messages/view', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function delete($id)
	{
		$contact_message = $this->ContactMessageModel->show($id);
		if($contact_message->is_read == 0) {
			$this->session->set_flashdata('error', $this->lang->line('contact_message_can_not_delete'));
			redirect(base_url('admin/contact/messages'));
		}

		$delete = $this->ContactMessageModel->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', $this->lang->line('contact_message_delete_success'));
			redirect(base_url('admin/contact/messages'));
		} else {
			$this->session->set_flashdata('error', $this->lang->line('contact_message_delete_error'));
			redirect(base_url('admin/contact/messages'));
		}
	}
}
