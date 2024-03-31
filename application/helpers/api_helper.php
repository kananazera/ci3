<?php

function jsonResponse($code, $message, $data = null, $response_code = 0)
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
