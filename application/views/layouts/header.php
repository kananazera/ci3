<!doctype html>
<html lang="<?= $this->session->userdata('lang') ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="<?= $this->config->item('meta_keywords') ?>">
	<meta name="description" content="<?= $this->config->item('meta_description') ?>">
	<title><?= $title ?> - <?= $this->config->item('app_name') ?></title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/aos.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>

<?php $this->load->view('layouts/nav'); ?>
<?php $this->load->view('layouts/offcanvas'); ?>
