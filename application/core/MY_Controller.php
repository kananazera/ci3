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
	}

	public function response($code, $message, $data = null, $response_code = 0)
	{
		header('Content-Type: application/json');
		http_response_code($response_code);
		$arr = array(
			'code' => $code,
			'message' => $message,
			'data' => $data,
		);
		echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	}
}
