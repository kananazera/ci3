<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LanguageController extends MY_Controller
{
	public function switchLang($lang)
	{
		$check = array_key_exists($lang, $this->config->item('languages'));
		if ($check === false) {
			redirect(base_url());
		} else {
			$this->session->set_userdata('lang', $lang);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
