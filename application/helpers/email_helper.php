<?php

function sendEmail($to, $subject, $message)
{
	$ci = &get_instance();

	$ci->load->library('email');

	$config['protocol'] = 'smtp';
	$config['smtp_host'] = $ci->config->item('smtp_host');
	$config['smtp_port'] = $ci->config->item('smtp_port');
	$config['smtp_user'] = $ci->config->item('smtp_user');
	$config['smtp_pass'] = $ci->config->item('smtp_pass');
	$config['smtp_timeout'] = '7';
	$config['charset'] = 'utf-8';
	$config['newline'] = "\r\n";
	$config['mailtype'] = 'html';
	$config['validation'] = true;

	$ci->email->initialize($config);
	$ci->email->from($ci->config->item('admin_email'), $ci->config->item('app_name'));
	$ci->email->to($to);
	$ci->email->subject($subject);
	$ci->email->message($message);

	if ($ci->email->send()) {
		return true;
	} else {
		return false;
	}
}
