<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PageController extends MY_Controller
{
	public function contact()
	{
		$header['title'] = $this->lang->line('contact');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('pages/contact');
		$this->load->view('layouts/footer');
	}

	public function about()
	{
		$header['title'] = $this->lang->line('about');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('pages/about');
		$this->load->view('layouts/footer');
	}

	public function privacyPolicy()
	{
		$header['title'] = $this->lang->line('privacy_policy');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('pages/privacy_policy');
		$this->load->view('layouts/footer');
	}

	public function termsAndConditions()
	{
		$header['title'] = $this->lang->line('terms_and_conditions');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('pages/terms_and_conditions');
		$this->load->view('layouts/footer');
	}

	public function error404()
	{
		$header['title'] = $this->lang->line('error_404_title');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('pages/error404');
		$this->load->view('layouts/footer');
	}

	public function error403()
	{
		$header['title'] = $this->lang->line('error_403_title');

		$this->load->view('layouts/header', $header);
		$this->load->view('layouts/nav');
		$this->load->view('pages/error403');
		$this->load->view('layouts/footer');
	}
}
