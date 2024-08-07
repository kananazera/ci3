<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('lang')) {
			$this->session->set_userdata('lang', $this->config->item('language'));
		}
		$this->lang->load('translate', $this->session->userdata('lang'));

		$this->load->model('PageModel');

		$data['navigation_pages'] = $this->PageModel->getNavigationPages($this->session->userdata('lang'));
		$data['footer_pages'] = $this->PageModel->getFooterPages($this->session->userdata('lang'));
		$this->load->vars($data);
	}
}
