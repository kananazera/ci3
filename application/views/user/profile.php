<div class="container" data-aos="zoom-in-up">

	<h3 class="text-center mb-3">
		<?= $this->lang->line('profile') ?>
	</h3>

	<?php if ($this->session->flashdata('success')) : ?>
		<div class="text-center alert alert-success">
			<?= $this->session->flashdata('success') ?>
		</div>
	<?php endif ?>

	<?php if ($this->session->flashdata('error')) : ?>
		<div class="text-center alert alert-danger">
			<?= $this->session->flashdata('error') ?>
		</div>
	<?php endif ?>

	<div class="row">

		<div class="col-12 col-md-4 mb-3 mb-md-0">
			<?php $this->view('user/information'); ?>
		</div>

		<div class="col-12 col-md-4 mb-3 mb-md-0">
			<?php $this->view('user/password'); ?>
		</div>

		<div class="col-12 col-md-4">
			<?php $this->view('user/photo'); ?>
		</div>

	</div>

</div>
