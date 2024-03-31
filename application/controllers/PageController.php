<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PageController extends MY_Controller
{
	public function index()
	{
		$header['title'] = $this->lang->line('pages');

		$data['pages'] = $this->PageModel->getPages($this->session->userdata('lang'));

		$this->load->view('layouts/header', $header);
		$this->load->view('pages/index', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function page($slug)
	{
		$data['page'] = $this->PageModel->page($slug, $this->session->userdata('lang'));
		if ($data['page'] == false) {
			$data['page'] = $this->PageModel->page($slug, $this->config->item('language'));
		}
		$header['title'] = $data['page']->title;
		$footer['pages'] = $this->PageModel->getPages($this->session->userdata('lang'));

		$this->load->view('layouts/header', $header);
		$this->load->view('pages/page', $data);
		$this->load->view('layouts/footer', $footer);
	}

	public function error404()
	{
		$header['title'] = $this->lang->line('error_404_title');
		$footer['pages'] = $this->PageModel->getPages($this->session->userdata('lang'));

		$this->load->view('layouts/header', $header);
		$this->load->view('pages/error404');
		$this->load->view('layouts/footer', $footer);
	}

	public function error403()
	{
		$header['title'] = $this->lang->line('error_403_title');
		$footer['pages'] = $this->PageModel->getPages($this->session->userdata('lang'));

		$this->load->view('layouts/header', $header);
		$this->load->view('pages/error403');
		$this->load->view('layouts/footer', $footer);
	}
}
