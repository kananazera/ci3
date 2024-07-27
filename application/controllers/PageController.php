<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PageController extends MY_Controller
{
	public function page($slug)
	{
		$data['page'] = $this->PageModel->page($slug, $this->session->userdata('lang'));
		if ($data['page'] == false) {
			$data['page'] = $this->PageModel->page($slug, $this->config->item('language'));
		}
		$header['title'] = $data['page']->title;

		$this->load->view('layouts/header', $header);
		$this->load->view('pages/page', $data);
		$this->load->view('layouts/footer');
	}

	public function error404()
	{
		$header['title'] = $this->lang->line('error_404_title');

		$this->load->view('layouts/header', $header);
		$this->load->view('pages/error404');
		$this->load->view('layouts/footer');
	}

	public function error403()
	{
		$header['title'] = $this->lang->line('error_403_title');

		$this->load->view('layouts/header', $header);
		$this->load->view('pages/error403');
		$this->load->view('layouts/footer');
	}
}
