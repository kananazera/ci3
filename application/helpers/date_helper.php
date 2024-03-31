<?php

function generateDate($date, $type = '')
{
	$ci = &get_instance();

	if ($type == 'birthday') {
		$pattern = '/(\d{4})-(\d{2})-(\d{2})/';
	} else {
		$pattern = '/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/';
	}

	preg_match($pattern, $date, $matches);

	$year = $matches[1];

	$month = str_replace([
		'01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',
	], [
		$ci->lang->line('january'),
		$ci->lang->line('february'),
		$ci->lang->line('march'),
		$ci->lang->line('april'),
		$ci->lang->line('may'),
		$ci->lang->line('june'),
		$ci->lang->line('july'),
		$ci->lang->line('august'),
		$ci->lang->line('september'),
		$ci->lang->line('october'),
		$ci->lang->line('november'),
		$ci->lang->line('december'),
	], $matches[2]);

	$day = str_replace([
		'01', '02', '03', '04', '05', '06', '07', '08', '09',
	], [
		'1', '2', '3', '4', '5', '6', '7', '8', '9',
	], $matches[3]);

	if ($type == 'birthday') {
		return $day . ' ' . $month . ' ' . $year;
	}

	$hour = $matches[4];
	$minute = $matches[5];

	$time = $hour . ':' . $minute;

	if ($day == date('d')) {
		return $ci->lang->line('today') . ' ' . $time;
	}

	if ($day == date('d', strtotime('-1 day'))) {
		return $ci->lang->line('yesterday') . ' ' . $time;
	}

	if ($year != date('Y')) {
		return $day . ' ' . $month . ' ' . $year . ' ' . $time;
	}

	return $day . ' ' . $month . ' ' . $time;
}
