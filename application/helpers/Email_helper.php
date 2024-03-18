<?php

namespace helpers;

class Email_helper
{
	public function config()
	{
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'kananazera@gmail.com';
		$config['smtp_pass'] = 'oroatcjewwhexspg';
		$config['smtp_timeout'] = '7';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = true;
		return $config;
	}
}
